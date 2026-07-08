<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    //
    public function index()
    {
        return view('welcome');
    }

        public function index1()
    {
        return view('frontend.index-backup');
    }
}
