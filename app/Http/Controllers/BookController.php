<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBookStore;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $searchValue = $request->get('search');
        $query = Book::query();

        if ($searchValue) {
            $query->where('title', 'like', '%' . $searchValue . '%');
        }

        $books = $query->get();

        if ($books->isEmpty()) {
            return response()->json([
                'message' => 'No books found.'
            ], 404);
        }

        return BookResource::collection($books);
    }

    public function store(RequestBookStore $request)
    {
        $book = Book::create($request->validated());

        if ($request->has('category_ids')) {
            $book->categories()->attach($request->input('category_ids'));
        }

        return response()->json([
            'message' => 'Successfully created book.',
            'data' => new BookResource($book->load('categories')),
        ], 201);
    }

    public function show(string $id)
    {
        $book = Book::with('categories')->find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        return new BookResource($book);
    }

    public function update(RequestBookStore $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        $book->update($request->validated());

        if ($request->has('category_ids')) {
            $book->categories()->sync($request->input('category_ids'));
        }

        return response()->json([
            'message' => 'Book updated successfully.',
            'data' => new BookResource($book->load('categories')),
        ]);
    }

    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully.'
        ]);
    }
}