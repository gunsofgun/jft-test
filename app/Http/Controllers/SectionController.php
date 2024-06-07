<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\GroupOption;
use Illuminate\Http\Request;
use App\Models\UserAnswerDetail;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class SectionController extends Controller
{
    function index(string $id)
    {
        $users = User::where('role', 'user')->where('package', $id)->get();
        $usersResult = [];
        $i = 0;

        foreach ($users as $user) {
            
            // Kalkulasi Hasil
            $sum_correct = 0;

            $user_answer = UserAnswer::where('user_id', $user->id)->first();
            
            if($user_answer != null) {

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
    
                // Hasil akhir jumlah jawaban yang benar dikali 4
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
                    'name' => $user->name,
                    'user_id' => $user->id,
                    'total_point' => $sum_correct,
                    'persenOne' => $persenOne,
                    'persenTwo' => $persenTwo,
                    'persenThree' => $persenThree,
                    'persenFour' => $persenFour,
                ];
    
                $usersResult[$i] = $data;
                $i++;
            }
        }

        $data = Section::where('package_test_id', $id)->get();
        return view('admin/section/index')
            ->with([
                    'data' => $data,
                    'result' => $usersResult
                ]);
    }

    function download_pdf(string $uid)
    {
        // Kalkulasi Hasil
        $sum_correct = 0;

        $user_answer = UserAnswer::where('user_id', $uid)->first();

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

        // Hasil akhir jumlah jawaban yang benar dikali 4
        $data_user = User::where('id', $uid)->first();

        $group_option = GroupOption::get();

        $sectionScores = [];
        $sectionQuestionCounts = [];

        // Inisialisasi array untuk menyimpan skor per section
        foreach ($answered as $userAnswerDetail) {
            $sectionId = $userAnswerDetail->section_id;
            $sectionScores[$sectionId] = 0;
            $sectionQuestionCounts[$sectionId] = 0;

            if($sectionId > 4) {
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

