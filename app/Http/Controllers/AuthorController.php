<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAuthorStore;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $searchValue = $request->get('search');
        $query = Author::query();

        if ($searchValue) {
            $query->where('name', 'like', '%' . $searchValue . '%');
        }

        $authors = $query->get();

        if ($authors->isEmpty()) {
            return response()->json([
                'message' => 'No authors found.'
            ], 404);
        }

        return AuthorResource::collection($authors);
    }

    public function store(RequestAuthorStore $request)
    {
        $author = Author::create($request->validated());

        return response()->json([
            'message' => 'Successfully created author.',
            'data' => new AuthorResource($author),
        ], 201);
    }

    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found.'
            ], 404);
        }

        return new AuthorResource($author);
    }

    public function update(RequestAuthorStore $request, string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found.'
            ], 404);
        }

        $author->update($request->validated());

        return response()->json([
            'message' => 'Author updated successfully.',
            'data' => new AuthorResource($author),
        ]);
    }

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