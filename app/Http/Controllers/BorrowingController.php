<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
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
            'user_nim' => $request->user_nim,
            'book_code' => $request->book_code,
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
                    'success' => 'Pengajuan peminjaman telah dilakukan, tunggu di acc pegawai dan cek Peminjaman Saya'
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
            'user_nim' => $request->user_nim,
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
                    'success' => 'Peminjaman telah Disetujui'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi Error'
                ]);
        }
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }
}
