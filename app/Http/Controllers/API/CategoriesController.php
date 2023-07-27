<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesdata = [];
        $categories = Category::all();
        foreach ($categories as $category) {
            $num_books = $category->books()->count();
            $categoriesdata[] = [
                'name' => $category->name,
                'description' => $category->description,
                'num_books' => $num_books
            ];
        }
        return response()->json($categoriesdata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {


        $validateData = $request->validate([
        ]);
            $category = new Category;
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            $num_books = $category->books()->count();
            return response()->json([
                'name' => $category->name,
                'description' => $category->description,
                'num_books' => $num_books
            ]);
            // return response()->json($category, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $category->fill($request->post())->save();
        $num_books = $category->books()->count();
        return response()->json(
            [
            'name' => $category->name,
            'description' => $category->description,
            'num_books' => $num_books
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted.']);
    }
}
