<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Middleware\CheckAge;
use App\Models\User; // the model to be used for the eloquent orm
use Illuminate\Support\Facades\DB; // to be used for the query builder

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo "Home Page...";
});


// Route::get('/about', function(){
//     return view('about');
// })->middleware([CheckAge::class]);

Route::get('/about', function(){
    return view('about');
});

// Route::get('/contact', 'ContactController@index'); // this is for the laravel 6 & 7

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

// Category routes
Route::get('/category/all', [CategoryController::class, 'allCategories'])->name('all.categories');
Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCategory']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'permanentDelete']);


// Brand routes
Route::get('/brand/all', [BrandController::class, 'allBrands'])->name('all.brands');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    $users = User::all(); // Eloquent ORM
    // $users = DB::table('users')->get(); // Query Builder

    return view('dashboard', compact('users'));
})->name('dashboard');
