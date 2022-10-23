<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePassword;
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

// email verification route
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    // return view('welcome');
    $brands = DB::table('brands')->get();
    $abouts = DB::table('abouts')->first();
    return view('home', compact('brands', 'abouts'));
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

// Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

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
Route::get('/delete/brand/{id}', [BrandController::class, 'deleteBrand']);

// Multi Image routes
Route::get('/multi/image', [BrandController::class, 'multipic'])->name('multi.image');
Route::post('/multipic/add', [BrandController::class, 'addMultipic'])->name('store.multipic');

// Slider Routes
Route::get('/slider', [HomeController::class, 'slider'])->name('slider');
Route::get('add/slider', [HomeController::class, 'addSlider'])->name('add.slider');
Route::post('store/slider', [HomeController::class, 'storeSlider'])->name('store.slider');

// About Routes
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('add/about', [AboutController::class, 'addAbout'])->name('add.about');
Route::post('store/about', [AboutController::class, 'storeAbout'])->name('store.about');

Route::get('/about/edit/{id}', [AboutController::class, 'editAbout']);
Route::post('/about/update/{id}', [AboutController::class, 'updateAbout']);
Route::get('/delete/about/{id}', [AboutController::class, 'deleteAbout']);

// CONTACT ROUTES
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
//     $users = User::all(); // Eloquent ORM
//     // $users = DB::table('users')->get(); // Query Builder

//     return view('dashboard', compact('users'));
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');


// CHANGE PASSWORD AND USER PROFILE ROUTES

Route::get('/user/change-password', [ChangePassword::class, 'changePassword'])->name('password.change');
Route::post('/user/update-password', [ChangePassword::class, 'updatePassword'])->name('password.update');
