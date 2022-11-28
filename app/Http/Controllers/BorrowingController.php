<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    //
    public function index()
    {
        $borrowings = Borrowing::latest()->where('accept_borrow','=',false)->get();
        return view('borrowings.index', compact('borrowings'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        $borrowing = Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'accept_borrow' => false,
            'accept_return' => false,
            'date' => date("Y-m-d"),
            'date_return' => date('Y-m-d', strtotime(date('Y-m-d'). ' +14 days')),
            'propose_return' => false,
        ]);

        $book = Book::findOrFail($borrowing->book_id);

        $book->update([
            'isBorrowed' => true,
        ]);

        if ($borrowing) {
            return redirect()
                ->route('book.index')
                ->with([
                    'success' => 'Peminjaman berhasil dilakukan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Peminjaman gagal dilakukan'
                ]);
        }
    }
    public function update(Request $request, $id)
    {

        $borrowing = Borrowing::findOrFail($id);

        $borrowing->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'accept_borrow' => true,
            'accept_return' => false,
            'date' => date("Y-m-d"),
            'date_return' => date('Y-m-d', strtotime(date('Y-m-d'). ' +14 days')),
            'propose_return' => false,
        ]);

        if ($borrowing) {
            return redirect()
                ->route('borrowing.index')
                ->with([
                    'success' => 'borrowing has been updated successfully'
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
