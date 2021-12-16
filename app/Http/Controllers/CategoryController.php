<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories(){
        return view('admin.category.index');
    }
}
