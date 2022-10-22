<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function about(){
        $abouts = About::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }
}
