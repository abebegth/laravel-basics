<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function slider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider(){
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request){
        $slider_image = $request->file('image'); // get the uploaded image

        
        // using image intervention package
        $generated_name = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('images/slider/'.$generated_name);
        $last_image = 'images/slider/'.$generated_name;

        // Eloquent ORM --- Insert into the database
        Slider::insert([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$last_image,
            'created_at'=>Carbon::now()
        ]);

        return Redirect()->route('slider')->with('success', "Slider inserted successfully");
    }
}
