<?php

namespace App\Http\Controllers;

use App\Models\PackageTest;
use Illuminate\Http\Request;

class PackageTestController extends Controller
{
    function index() {
        $data = PackageTest::get();
        return view('admin/package-test/index')->with('data', $data);
    }
}
