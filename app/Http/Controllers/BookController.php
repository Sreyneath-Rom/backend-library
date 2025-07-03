<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBookStore;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // GET /api/books
    public function index(Request $request)
    {
        try {
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

            return response()->json(BookResource::collection($books), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching books.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // POST /api/books
    public function store(RequestBookStore $request)
    {
        $book = Book::create($request->validated());

        return response()->json([
            'message' => 'Successfully created book.',
            'data' => $book,
        ], 201);
    }

    // GET /api/books/{book}
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        return response()->json([
            'data' => $book
        ]);
    }

    // PUT/PATCH /api/books/{book}
    public function update(RequestBookStore $request, string $id)
    {
        $book = Book::find($id);

        $book->update($request->validated());

        return response()->json([
            'message' => 'Book updated successfully.',
            'data' => $book
        ]);
    }

    // DELETE /api/books/{book}
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'book not found.'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully.'
        ]);
    }
}