<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$images = Images::orderBy('created_at', 'desc')->paginate(30);

        return view('home', compact('images'));
    }
}
