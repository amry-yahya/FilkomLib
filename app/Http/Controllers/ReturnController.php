<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    //
    public function index()
    {
        $returns = Borrowing::latest()->where('accept_borrow','=',true)->get();
        return view('returns.index', compact('returns'));
    }
    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();
        $book = Book::findOrFail($borrowing->book_id);

        $book->update([
            'isBorrowed' => false,
        ]);
        if ($borrowing) {
            return redirect()
                ->route('return.index')
                ->with([
                    'success' => 'Pengembalian telah Disetujui'
                ]);
        } else {
            return redirect()
                ->route('return.index')
                ->with([
                    'error' => 'Terjadi Error'
                ]);
        }
    }
}
