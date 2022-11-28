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
                    'success' => 'New book has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
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
                    'success' => 'book has been updated successfully'
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
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        if ($book) {
            return redirect()
                ->route('book.index')
                ->with([
                    'success' => 'book has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('book.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
