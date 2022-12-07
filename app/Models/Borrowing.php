<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','user_nim', 'book_id','book_code','accept_borrow','accept_return','date','date_return','propose_return'
    ];
}
