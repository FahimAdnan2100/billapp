<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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
Route::post('/store',[ProductController::class,'AddProducts']);
Route::post('/addproduct1',[ProfileController::class,'AddProducts']);
Route::get('/show',[ProductController::class,'ShowProducts']);
Route::get('/pname',[ProductController::class,'ProductName']);
Route::get('/edit/{id}',[ProductController::class,'EditProduct']);
Route::get('/qty/{id}',[ProductController::class,'QtyProduct']);
Route::get('/genarate',[ProductController::class,'genarateBIllNo']);
Route::get('/bill',[ProductController::class,'BillSe']);
Route::post('/save',[ProductController::class,'SaveBill']);