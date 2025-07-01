<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book ;
use App\Models\Author;


class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure you have authors first
        if (Author::count() === 0) {
            Author::factory(10)->create();
        }

        // Create 30 books, each linked to a random author
        Book::factory(10)->create([
            'author_id' => Author::inRandomOrder()->first()->id,
        ]);
    }
}