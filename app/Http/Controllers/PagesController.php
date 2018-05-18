<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $title = 'Home';
        return view('home')->with('title', $title);
    }

    public function user(){
        $title = 'User';
        return view('user.index')->with('title', $title);
    }
}