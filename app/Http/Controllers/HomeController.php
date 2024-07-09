<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function kontak()
    {
        return view('frontend.kontak');
    }

    public function tentang()
    {
        return view('frontend.tentang');
    }

}
