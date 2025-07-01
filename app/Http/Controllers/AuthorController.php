<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAuthorStore;
use App\Models\Author;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Author::all();
        return response()->json($author);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestAuthorStore $request)
    {
        $author = Author::create($request->validated());

        return response()->json([
            'message' => 'Successfully created author.',
            'data' => $author,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found.'
            ], 404);
        }

        return response()->json([
            'data' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestAuthorStore $request, string $id)
    
    {
        $author = Author::find($id);

        $author->update($request->validated());

        return response()->json([
            'message' => 'Author updated successfully.',
            'data' => $author
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found.'
            ], 404);
        }
    
        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully.'
        ]);
    }
}