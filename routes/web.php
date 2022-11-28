<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MyBorrowingController;
use App\Http\Controllers\ReturnController;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

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
    return redirect('/login');
});
Auth::routes();
Route::resource('book', BookController::class)->middleware('auth');
Route::resource('borrowing', BorrowingController::class)->middleware('auth');
Route::resource('myborrowing', MyBorrowingController::class)->middleware('auth');
Route::resource('return', ReturnController::class)->middleware('auth');

Route::get('/home', function () {
    return redirect('/book');
});