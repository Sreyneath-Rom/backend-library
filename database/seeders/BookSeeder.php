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
        $authors = Author::all();
        $categories = Category::all();

        if ($authors->count() === 0 || $categories->count() === 0) {
            $this->command->info('Please seed authors and categories before seeding books.');
            return;
        }

        Book::factory(20)
            ->make() // Create unsaved book models
            ->each(function ($book) use ($authors, $categories) {
                $book->author_id = $authors->random()->id;
                $book->save();

                $book->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}