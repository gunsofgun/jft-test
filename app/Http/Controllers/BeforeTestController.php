<?php

namespace App\Http\Controllers;

use App\Models\PackageTest;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeforeTestController extends Controller
{
    function index() {
        return view('before-test/index');
    }

    function instruction() {
        $user = Auth::user();
        $package_id_user = $user->package;

        $data_package = PackageTest::where('id', $package_id_user)->first();
        $data_section = Section::where('package_test_id', $package_id_user)->get(); //1, 2, 3, 4

        $total_question = 0;
        foreach ($data_section as $data) {
            $data_question = Question::where('section_id', $data->id)->get();
            $total_question += $data_question->count();
        }

        $data = [
            'datap' => $data_package,
            'totalq' => $total_question,
            'sec_id' => $data_section[0]->id
        ];

        return view('before-test/instruction')->with('data', $data);
    }
}
