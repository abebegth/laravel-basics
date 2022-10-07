<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function allBrands(){

        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function addBrand(Request $request){

        $validateData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|max:255',
                'brand_image' => 'required|mimes:jpg,jpeg,png'
            ],
            [
                'brand_name.required' =>"Please enter Brand name",
                'brand_image.required' =>"Please upload a brand image"
            ]
        );

        $brand_image = $request->file('brand_image'); // get the uploaded image

        $generated_name = hexdec(uniqid()); // a unique id/name generated for the image to be used as a name.
        $img_ext = strtolower($brand_image->getClientOriginalExtension()); // to get the extension of the original image
        $img_name = $generated_name.'.'.$img_ext; // concatinate the uniquely generated image name and the extension

        $upload_location = 'images/brand/'; // the folder to which the image is going to be saved.
        $last_image = $upload_location.$img_name; // the path with the new image name.

        $brand_image->move($upload_location, $img_name); // move the uploaded image to the specified path

        // Eloquent ORM --- Insert into the database
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_image,
            'created_at'=>Carbon::now()
        ]);

        return Redirect()->back()->with('success', "Brand inserted successfully");

    }
}
