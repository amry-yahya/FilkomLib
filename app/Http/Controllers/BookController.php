<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::latest()->where('isBorrowed','=',false)->get();
        return view('books.index', compact('books'));
    }
    public function create()
    {
        return view('books.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:155',
            'code' => 'required',
            'writer' => 'required'
        ]);

        $book = Book::create([
            'title' => $request->title,
            'code' => $request->code,
            'writer' => $request->writer,
            'year' => $request->year,
            'isBorrowed' => false,
        ]);

        if ($book) {
            return redirect()
                ->route('book.index')
                ->with([
                    'success' => 'Data Buku Berhasil Ditambahkan'
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
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:155',
            'code' => 'required',
            'writer' => 'required',
        ]);

        $book = Book::findOrFail($id);

        $book->update([
            'title' => $request->title,
            'code' => $request->code,
            'writer' => $request->writer,
            'year' => $request->year,
            'isBorrowed' => false,
        ]);

        if ($book) {
            return redirect()
                ->route('book.index')
                ->with([
                    'success' => 'Data Buku Telah Diperbarui'
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
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        if ($book) {
            return redirect()
                ->route('book.index')
                ->with([
                    'success' => 'Buku Telah Dihapus'
                ]);
        } else {
            return redirect()
                ->route('book.index')
                ->with([
                    'error' => 'Terjadi Error'
                ]);
        }
    }
}
