<?php

namespace App\Http\Controllers;

use App\Models\GroupOption;
use App\Models\PackageTest;
use App\Models\Question;
use App\Models\Section;
use App\Models\UserAnswer;
use App\Models\UserAnswerDetail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JftTestConstroller extends Controller
{
    function index(string $ids, string $num) {
        $id_user = Auth::user()->id;

        $user_answer = UserAnswer::where('user_id', $id_user)->first();

        if ($user_answer) {
            if ($user_answer->is_done) {
                return view('test/result');
            }
            $user_answer = $user_answer->id;
        } else {
            $data = [
                'is_done' => false,
                'user_id' => $id_user
            ];

            $user_answer = UserAnswer::create($data)->id;
        }

        $data_package = PackageTest::where('id', Auth::user()->package)->first();
        $data_question = Question::where('section_id', $ids)->get()->sortBy('que_num');
        $latest_q = $data_question->last();
	    $selected_question = $data_question->where('que_num', $num)->first();

        $user_answer_check = UserAnswer::where('user_id', $id_user)->first();
        $user_answered_details = UserAnswerDetail::where('user_answer_id', $user_answer_check->id)->get();

        $que_answered = [];
        $que_answered_all = [];

        if(!$user_answered_details->isEmpty()) {
            $que_answered = UserAnswerDetail::where('user_answer_id', $user_answer_check->id)->where('question_test_id', $selected_question->id)->first();
            $que_answered_all = UserAnswerDetail::where('user_answer_id', $user_answer_check->id)->where('section_id', $ids)->get();
        }
        
        
        return view('test/index',)->with([
            'data_p' => $data_package,
            'data_q' => $data_question,
            'que_selected' => $selected_question,
            'user_answer' => $user_answer,
            'latest_q' => $latest_q,
            'que_answered' => $que_answered,
            'que_answered_all' => $que_answered_all,
        ]);
    }

    function store(Request $request) {
        $request->validate([
            'answer_char' => 'required',
            'question_test_id' => 'required',
            'section_id' => 'required',
            'user_answer_id' => 'required'
        ], [
            'answer_char.required' => 'Pilihan Wajib Diisi!',
        ]);

        $data_answer = [
            'answer_char' => $request->input('answer_char'),
            'question_test_id' => $request->input('question_test_id'),
            'section_id' => $request->input('section_id'),
            'user_answer_id' => $request->input('user_answer_id')
        ];

        $user_answer_detail = UserAnswerDetail::where('question_test_id', $request->input('question_test_id'))->first();

        if($user_answer_detail){
            $user_answer_detail->update($data_answer);
        }else{
            UserAnswerDetail::create($data_answer);
        }

        $question_num = Question::find($request->input('question_test_id'))->que_num;
        if($request->input('movement') == 'next'){
            $question_num++;
        }else{
            $question_num--;
        }

        $sec_id = 1;
        $question_any = Question::where('section_id', $request->input('section_id'))->where('que_num', $question_num)->first();
        if($question_any){
            $sec_id = $request->input('section_id');
        }else{
            $sec_id = $request->input('section_id') + 1;

            $section_find = Question::where('section_id', $sec_id)->first();
            if($section_find) {
                $sec_id = $sec_id;
            }else{
                $sec_id = $sec_id + 1;
            }
            
            $question_num = $section_find->que_num;
        }


        if($request->input('movement') == 'finish'){
            $user_answer = UserAnswer::where('user_id', Auth::user()->id)->first();
            $user_answer->update(['is_done' => true]);
            return redirect('/result-test');
        }else{
            return redirect('/do-test/sec/'. $sec_id .'/que/' . $question_num);
        }
    }

    function result() {
        return view('test/result');
    }

    function download_pdf() {
        // Kalkulasi Hasil
        $sum_correct = 0;

        $user_answer = UserAnswer::where('user_id', Auth::user()->id)->first();
        
        $correct_data = GroupOption::get();
        $answered = UserAnswerDetail::where('user_answer_id', $user_answer->id)->get();
        $questions = Question::get();

        $userAnswerDetails = $answered->toArray();
        $groupOptions = $correct_data->toArray();
        $questionsArr = $questions->toArray();

        $firstSection = 1;

        // Iterasi melalui detail jawaban pengguna
        foreach ($userAnswerDetails as $userAnswerDetail) {
            // Mengambil answer_char dari detail jawaban pengguna
            $answerChar = $userAnswerDetail['answer_char'];

            // Mencari opsi grup yang sesuai dengan pertanyaan menggunakan question_test_id
            $groupOption = array_filter($groupOptions, function ($option) use ($userAnswerDetail) {
                return $option['question_id'] == $userAnswerDetail['question_test_id'];
            });

            $scoreQuestion = array_filter($questionsArr, function ($que) use ($userAnswerDetail) {
                return $que['id'] == $userAnswerDetail['question_test_id'];
            });

            // Jika opsi grup ditemukan
            if (!empty($groupOption)) {
                // Mengambil opt_correct dari opsi grup
                $optCorrect = reset($groupOption)['opt_correct'];
                $scoreQ = reset($scoreQuestion)['que_score'];

                // Membandingkan answer_char dan opt_correct
                if ($answerChar === $optCorrect) {
                    // Jika benar, menambahkan nilai $sum_correct
                    $sum_correct = $sum_correct + $scoreQ;
                }
            }
        }

        $data_user = Auth::user();

        $group_option = GroupOption::get();

        $sectionScores = [];
        $sectionQuestionCounts = [];

        // Inisialisasi array untuk menyimpan skor per section
        foreach ($answered as $userAnswerDetail) {
            $sectionId = $userAnswerDetail->section_id;
            $sectionScores[$sectionId] = 0;
            $sectionQuestionCounts[$sectionId] = 0;

            if ($sectionId > 4) {
                $firstSection = 5;
            }
        }

        // Hitung jumlah soal per section
        foreach ($questions as $question) {
            if (isset($sectionQuestionCounts[$question->section_id])) {
                $sectionQuestionCounts[$question->section_id]++;
            }
        }

        // Iterasi setiap jawaban pengguna dan hitung skor
        foreach ($answered as $userAnswerDetail) {
            $questionId = $userAnswerDetail->question_test_id;
            $correctOption = $group_option->where('question_id', $questionId)->where('opt_correct', $userAnswerDetail->answer_char)->first();

            // Jika jawaban tidak ditemukan, lanjutkan ke jawaban pengguna berikutnya
            if (!$correctOption) {
                continue;
            }

            // Bandingkan jawaban pengguna dengan jawaban yang benar
            if ($userAnswerDetail->answer_char == $correctOption->opt_correct) {
                // Jika benar, tambahkan skor pertanyaan ke skor section
                $sectionScores[$userAnswerDetail->section_id] += 1; // Misalnya, tambahkan 1 ke skor setiap pertanyaan yang benar
            }
        }

        $persenOne = isset($sectionScores[$firstSection]) ? ($sectionScores[$firstSection] / $sectionQuestionCounts[$firstSection]) : 0;
        $persenTwo = isset($sectionScores[$firstSection + 1]) ? ($sectionScores[$firstSection + 1] / $sectionQuestionCounts[$firstSection + 1]) : 0;
        $persenThree = isset($sectionScores[$firstSection + 2]) ? ($sectionScores[$firstSection + 2] / $sectionQuestionCounts[$firstSection + 2]) : 0;
        $persenFour = isset($sectionScores[$firstSection + 3]) ? ($sectionScores[$firstSection + 3] / $sectionQuestionCounts[$firstSection + 3]) : 0;

        // Send Data
        $data = [
            'user' => $data_user,
            'total_point' => $sum_correct,
            'total_que' => count($correct_data),
            'persenOne' => $persenOne,
            'persenTwo' => $persenTwo,
            'persenThree' => $persenThree,
            'persenFour' => $persenFour,
        ];

        $file_name = strtolower($data_user->name);
        $file_name = str_replace(' ', '-', $file_name);

        // return view('test/result-pdf', $data);
        $pdf = PDF::loadview('test/result-pdf', $data)->setPaper('a4');
        return $pdf->download('result-jft-test-' . $file_name . '.pdf');
    }
}
