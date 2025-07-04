<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure authors and categories exist
        if (Author::count() === 0) {
            Author::factory(1)->create();
        }
        if (Category::count() === 0) {
            Category::factory(1)->create();
        }

        $authors = Author::all();
        $categories = Category::all();

        Book::factory(20)
            ->make() // make instances, don't save yet
            ->each(function ($book) use ($authors, $categories) {
                $book->author_id = $authors->random()->id;
                $book->save();

                // Attach 1–3 random categories
                $book->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}