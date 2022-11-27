<?php

namespace App\Http\Controllers;

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
        ]);

        if ($borrowing) {
            return redirect()
                ->route('borrowing.index')
                ->with([
                    'success' => 'New borrowing has been created successfully'
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
    public function update(Request $request, $id)
    {

        $borrowing = Borrowing::findOrFail($id);

        $borrowing->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'accept_borrow' => true,
            'accept_return' => false,
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
