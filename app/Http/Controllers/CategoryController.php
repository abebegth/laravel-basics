<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function allCategories(){

        // query builder
        // $categories = DB::table('categories')->join('users', 'categories.user_id', 'users.id')->select('categories.*', 'users.name')->latest()->paginate(5);


        // $categories = Category::all();
        $categories = Category::latest()->paginate(5); // Eloquent ORM
        $trashedCategories = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->get(); // Query Builder
        return view('admin.category.index', compact('categories', 'trashedCategories'));
    }

    public function addCategory(Request $request){
        $validateData = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255'
            ],
            [
                'category_name.required' =>"Please enter category name"
            ]
        );

        // Eloquent ORM
        // Category::insert([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id,
        //     'created_at'=>Carbon::now()
        // ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();


        // Query Builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', "Category inserted successfully");
    }

    public function editCategory($id){
        // $categoryById = Category::find($id); // Eloquent ORM

        // query builder
        $categoryById = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('categoryById'));
    }

    public function updateCategory(Request $request, $id){

        // Eloquent ORM
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        // Query Builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->where('id', $id)->update($data);


        return Redirect()->route('all.categories')->with('success', "Category Updated successfully");
    }

    public function softDelete($id){
        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success', 'Category Trashed...');
    }

    public function restoreCategory($id){
        $trashedCat = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restored...');
    }

    public function permanentDelete($id){
        $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Deleted Permanently...');
    }
}
