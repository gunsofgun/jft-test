<?php

namespace App\Http\Controllers;

use App\Models\GroupOption;
use App\Models\Option;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    function index(string $id)
    {
        $data = Question::where('section_id', $id)->get()->sortBy('que_num');
        $sec = Section::where('id', $id)->first();
        return view('admin/question/index')
            ->with(
                [
                    'data' => $data, 
                    'ids' => $id,
                    'section' => $sec
                ]);
    }

    function store(string $id, Request $request) {
        // create question
            $request->validate([
                'que_num' => 'required',
                'que_content' => 'required',
                'que_audio' => 'file',
                'que_img' => 'image|file',
                'que_score' => 'required'
            ]);

            $data_que = [
                'que_num' => $request->input('que_num'),
                'que_content' => $request->input('que_content'),
                'que_content_eng' => $request->input('que_content_eng'),
                'que_content_ind' => $request->input('que_content_ind'),
                'que_score' => $request->input('que_score'),
                'section_id' => $id
            ];

            if($request->file('que_img')) {
                $data_que['que_img'] = $request->file('que_img')->store('que-images');
            }

            if($request->file('que_audio')) {
                $data_que['que_audio'] = $request->file('que_audio')->store('que-audios');
            }
            
            $id_que = Question::create($data_que)->id;
        // end question

        // create group option
            $request->validate([
                'opt_correct' => 'required',
            ]);

            $data_opt_group = [
                'opt_title' => $request->input('opt_title'),
                'opt_correct' => $request->input('opt_correct'),
                'question_id' => $id_que
            ];

            $id_opt_group = GroupOption::create($data_opt_group)->id;
        // end group option

        // create option
            $request->validate([
                'opt_content_a' => 'required',
                'opt_content_b' => 'required',
                
		'opt_img_a' => 'image|file',
                'opt_img_b' => 'image|file',
                'opt_img_c' => 'image|file',
                'opt_img_d' => 'image|file'
            ]);

            $data_opt_a = [
                'opt_content' => $request->input('opt_content_a'),
                'opt_char' => 'A',
                'group_option_id' => $id_opt_group
            ];

            if ($request->file('opt_img_a')) {
                $data_opt_a['opt_img'] = $request->file('opt_img_a')->store('opt-images');
            }
            Option::create($data_opt_a);

            $data_opt_b = [
                'opt_content' => $request->input('opt_content_b'),
                'opt_char' => 'B',
                'group_option_id' => $id_opt_group
            ];

            if ($request->file('opt_img_b')) {
                $data_opt_b['opt_img'] = $request->file('opt_img_b')->store('opt-images');
            }
            Option::create($data_opt_b);

            $data_opt_c = [
                'opt_content' => $request->input('opt_content_c'),
                'opt_char' => 'C',
                'group_option_id' => $id_opt_group
            ];

            if ($request->file('opt_img_c')) {
                $data_opt_c['opt_img'] = $request->file('opt_img_c')->store('opt-images');
            }
            Option::create($data_opt_c);

            $data_opt_d = [
                'opt_content' => $request->input('opt_content_d'),
                'opt_char' => 'D',
                'group_option_id' => $id_opt_group
            ];

            if ($request->file('opt_img_d')) {
                $data_opt_d['opt_img'] = $request->file('opt_img_d')->store('opt-images');
            }
            Option::create($data_opt_d);
        // end option

        return redirect('section/' . $id)->with('success', 'Berhasil Membuat Soal!');
    }

    function delete(Request $request) {
        $gOpId = $request->input('group_option_id');
        $secId = $request->input('section_id');
        
        // Delete Option
        $option = Option::where('group_option_id', $gOpId)->get();
        foreach ($option as $item) {
            if($item->opt_img){
                Storage::delete($item->opt_img);
            }
        }
        Option::where('group_option_id', $gOpId)->delete();
        
        // Delete Group Option
        $go = GroupOption::where('id', $gOpId)->first();
        GroupOption::destroy($gOpId);

        // Delete Question
        $que = Question::where('id', $go->question_id)->first();
        if ($que->que_img) {
            Storage::delete($que->que_img);
        }
        if ($que->que_audio) {
            Storage::delete($que->que_audio);
        }
        Question::destroy($go->question_id);

        // Back
        return redirect('/section/' . $secId)->with('success', 'Berhasil hapus data!');
    }

    function edit(string $id) {
        $data = Question::where('id', $id)->first();
        return view('admin/question/edit')->with('data', $data);
    }

    function update(string $id, Request $request) {
        // update question
            $request->validate([
                'que_num' => 'required',
                'que_content' => 'required',
                'que_audio' => 'file',
                'que_img' => 'image|file',
                'que_score' => 'required'
            ]);

            $data_que = [
                'que_num' => $request->input('que_num'),
                'que_content' => $request->input('que_content'),
                'que_content_eng' => $request->input('que_content_eng'),
                'que_content_ind' => $request->input('que_content_ind'),
                'que_score' => $request->input('que_score'),
            ];

            if($request->file('que_img')) {
                Storage::delete($request->file('que_img'));
                $data_que['que_img'] = $request->file('que_img')->store('que-images');
            }

            if($request->file('que_audio')) {
                Storage::delete($request->file('que_audio'));
                $data_que['que_audio'] = $request->file('que_audio')->store('que-audios');
            }
            
            $question = Question::where('id', $id)->first();
            $question->update($data_que);
        // end question

        // create group option
            $request->validate([
                'opt_correct' => 'required',
            ]);

            $data_opt_group = [
                'opt_title' => $request->input('opt_title'),
                'opt_correct' => $request->input('opt_correct'),
            ];


            $opt_group = GroupOption::where('question_id', $id)->first();
            $opt_group->update($data_opt_group);
        // end group option

        // create option
            $request->validate([
                'opt_img_a' => 'image|file',
                'opt_img_b' => 'image|file',
                'opt_img_c' => 'image|file',
                'opt_img_d' => 'image|file'
            ]);

            // a
            $data_opt_a = [
                'opt_content' => $request->input('opt_content_a'),
            ];

            if ($request->file('opt_img_a')) {
                Storage::delete($request->file('opt_img_a'));
                $data_opt_a['opt_img'] = $request->file('opt_img_a')->store('opt-images');
            }
            Option::where('group_option_id', $opt_group->id)->where('opt_char', 'A')->update($data_opt_a);

            // b
            $data_opt_b = [
                'opt_content' => $request->input('opt_content_b'),
            ];

            if ($request->file('opt_img_b')) {
                Storage::delete($request->file('opt_img_b'));
                $data_opt_b['opt_img'] = $request->file('opt_img_b')->store('opt-images');
            }
            Option::where('group_option_id', $opt_group->id)->where('opt_char', 'B')->update($data_opt_b);

            // c
            $data_opt_c = [
                'opt_content' => $request->input('opt_content_c'),
            ];

            if ($request->file('opt_img_c')) {
                Storage::delete($request->file('opt_img_c'));
                $data_opt_c['opt_img'] = $request->file('opt_img_c')->store('opt-images');
            }
            Option::where('group_option_id', $opt_group->id)->where('opt_char', 'C')->update($data_opt_c);

            // d
            $data_opt_d = [
                'opt_content' => $request->input('opt_content_d'),
            ];

            if ($request->file('opt_img_d')) {
                Storage::delete($request->file('opt_img_d'));
                $data_opt_d['opt_img'] = $request->file('opt_img_d')->store('opt-images');
            }
            Option::where('group_option_id', $opt_group->id)->where('opt_char', 'D')->update($data_opt_d);
        // end option

        return redirect('section/' . $question->section_id)->with('success', 'Berhasil Membuat Soal!');
    }
}
