<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class MyBorrowingController extends Controller
{
    //
    public function index()
    {
        $borrowings = Borrowing::latest()->where('accept_borrow','=',true)->get();
        return view('myborrowings.index', compact('borrowings'));
    }
    public function update(Request $request, $id)
    {

        $borrowing = Borrowing::findOrFail($id);

        $borrowing->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'propose_return' => true,
        ]);

        if ($borrowing) {
            return redirect()
                ->route('myborrowing.index')
                ->with([
                    'success' => 'Pengajuan Telah Dikirim, Tunggu ACC dari Pegawai'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }
}
