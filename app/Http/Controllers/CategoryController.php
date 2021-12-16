<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories(){
        return view('admin.category.index');
    }

    public function addCategory(Request $request){
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ],
        [
            'category_name.required' =>"Please enter category name"
        ]
        );
    }
}
