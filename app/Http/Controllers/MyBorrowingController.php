<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class MyBorrowingController extends Controller
{
    //
    public function index()
    {
        $borrowings = Borrowing::latest()->where('accept_borrow','=',false)->get();
        return view('myborrowings.index', compact('borrowings'));
    }
}
