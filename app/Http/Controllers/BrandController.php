<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;

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

        // $generated_name = hexdec(uniqid()); // a unique id/name generated for the image to be used as a name.
        // $img_ext = strtolower($brand_image->getClientOriginalExtension()); // to get the extension of the original image
        // $img_name = $generated_name.'.'.$img_ext; // concatinate the uniquely generated image name and the extension

        // $upload_location = 'images/brand/'; // the folder to which the image is going to be saved.
        // $last_image = $upload_location.$img_name; // the path with the new image name.

        // $brand_image->move($upload_location, $img_name); // move the uploaded image to the specified path

        // using image intervention package
        $generated_name = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('images/brand/'.$generated_name);
        $last_image = 'images/brand/'.$generated_name;

        // Eloquent ORM --- Insert into the database
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_image,
            'created_at'=>Carbon::now()
        ]);

        return Redirect()->back()->with('success', "Brand inserted successfully");

    }

    public function editBrand($id){
        $brandById = Brand::find($id); // Eloquent ORM

        // query builder
        // $categoryById = DB::table('categories')->where('id', $id)->first();
        return view('admin.brand.edit', compact('brandById'));
    }

    public function updateBrand(Request $request, $id){

        $validateData = $request->validate(
            [
                'brand_name' => 'required|min:2'
            ],
            [
                'brand_name.required' =>"Please enter Brand name",
                'brand_name.min' =>"Brand name should be more than 2 characters"
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image'); // get the uploaded image

        if($brand_image){
            $generated_name = hexdec(uniqid()); // a unique id/name generated for the image to be used as a name.
            $img_ext = strtolower($brand_image->getClientOriginalExtension()); // to get the extension of the original image
            $img_name = $generated_name.'.'.$img_ext; // concatinate the uniquely generated image name and the extension

            $upload_location = 'images/brand/'; // the folder to which the image is going to be saved.
            $last_image = $upload_location.$img_name; // the path with the new image name.

            $brand_image->move($upload_location, $img_name); // move the uploaded image to the specified path

            unlink($old_image);

            // Eloquent ORM --- Update the brand
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'brand_image'=>$last_image,
                'created_at'=>Carbon::now()
            ]);

            return Redirect()->back()->with('success', "Brand Updated successfully");
        }
        else{
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'created_at'=>Carbon::now()
            ]);
            return Redirect()->back()->with('success', "Brand Updated successfully");
        }

        

    }

    public function deleteBrand($id){
        $brand = Brand::find($id);
        $image = $brand->brand_image;

        unlink($image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', "Brand Deleted successfully");
    }
}
