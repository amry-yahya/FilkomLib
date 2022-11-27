<?php

namespace App\Http\Controllers;

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

        if ($borrowing) {
            return redirect()
                ->route('borrowing.index')
                ->with([
                    'success' => 'borrowing has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('borrowing.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
