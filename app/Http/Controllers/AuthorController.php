<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAuthorStore;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;
use App\Models\Author;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $searchValue = $request->get('search');
            $query = Author::query();

            if ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            }

            $author = $query->get();

            if ($author->isEmpty()) {
                return response()->json([
                    'message' => 'No authors found.'
                ], 404);
            }

            return response()->json(AuthorResource::collection($author), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching author.',
                'error' => $e->getMessage()
            ], 500);
        }
       
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