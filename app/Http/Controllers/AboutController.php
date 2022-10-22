<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function about(){
        $abouts = About::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function addAbout(){
        return view('admin.about.create');
    }

    public function storeAbout(Request $request){

        About::insert([
            'title' => $request->title,
            'summary' => $request->summary,
            'detail' => $request->detail,
            'created_at'=>Carbon::now()
        ]);

        return Redirect()->route('about')->with('success', "About inserted successfully");
    }
}
