<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
// use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreauthorsRequest;




Use Illuminate\Support\Facades\Auth;
// use App\Http\Requests\AuthRequest;
// use App\Http\Requests\LoginRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     $authors = Authors::all();
    //     $authdata = [];

    //     foreach ($authors as $author) {
    //         $num_books = $author->books()->count();
    //         $authdata[] = [
    //             'id' => $author->id,
    //             'name' => $author->name,
    //             'num_books' => $num_books
    //         ];
    //     }

    //     return response()->json($authdata);
    //     //
    // }
    public function index()
{
    $authors = Author::all();

    return response()->json([
        'data' => $authors,
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreauthorsRequest $request)
    // {
    //     //
    //     $author = Author::create($request->all());
    //     return response()->json(["data"=>$author]
    //     , 201);
    // }
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        // 'email' => 'required|string|email|max:255|unique:authors,email',
        // "num_books"=>"required",

    ]);

    $author = Author::create($data);

    return response()->json([
        'message' => 'Author created successfully',
        'data' => $author,
    ], 201);
}

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $author = Author::find($id);

        if ($author) {
            $num_books = $author->books()->count();

            return response()->json([
                'id' => $author->id,
                'name' => $author->name,
                'num_books' => $num_books
            ]);
        } else {
            return response()->json(['message' => 'Author not found.'],404);
    }
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreauthorsRequest $request, $id)
    {
        $author = Author::find($id);
     if ($author) {
     $request->validate([
     'name' => 'required',
     ]);
     $author->update($request->all());
     return response()->json($author);
     } else {
     return response()->json(['message' => 'Author not found.'],404);
    }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $author = Author::find($id);
     if ($author) {
     $author->delete();
    //  return response()->json(['message' => 'Author delete.'], 204);
    return "user is deleted ";
     } else {
     return response()->json(['message' => 'Author not found.'],404);
    }
        //
    }
}
