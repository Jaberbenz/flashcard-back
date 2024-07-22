<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $category->delete();
        return response()->json(null, 204);
    }

    public function showCategoryDetails($id)
    {
        $category = Category::with('themes.cards')->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $themesDetails = $category->themes->map(function ($theme) {
            return [
                'theme' => $theme->name,
                'cards_count' => $theme->cards->count(),
            ];
        });

        return response()->json([
            'category' => $category->name,
            'themes_count' => $category->themes->count(),
            'themes_details' => $themesDetails,
        ]);
    }
}
