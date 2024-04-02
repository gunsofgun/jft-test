<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    function index(string $id)
    {
        $data = Section::where('package_test_id', $id)->get();
        return view('admin/section/index')->with('data', $data);
    }
}
