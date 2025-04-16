<?php
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
//use App\Http\Controllers\HomeControllerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('auth.login');
});
//
//Route::get('/', function () {
//    return view('welcome');
//});


//
//Auth::routes();
//
//Route::get('/home', [HomeController::class, 'index'])->name('home');
//Auth::routes(['register=>false']);
Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::resource('/invoices', [InvoiceController::class, 'index']);

//Route::get('/invoice',[InvoiceController::class,'index']);
Route::resource('/invoices',InvoiceController::class);
Route::resource('/sections',SectionController::class);
Route::resource('/products',ProductController::class);

Route::get('/show', [SectionController::class,'show']);

Route::get('/{page}', [AdminController::class,'index']);
