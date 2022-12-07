<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 10; $i++) { 
            $book = Book::create([
                'code' => "F-$i",
                'title' => "Title-$i",
                'writer' => "Writer-$i",
                'year' => $i+2000,
                'isBorrowed' => false,
            ]);
        }
    }
}
