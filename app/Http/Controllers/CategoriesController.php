<?php
namespace App\Http\Controllers;

use App\Models\Category;


class CategoriesController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);  // Fetch the category with its related products
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json($category);
    }
}