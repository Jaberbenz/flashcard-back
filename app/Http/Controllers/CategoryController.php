<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        ]);
    
        // Ajouter l'ID de l'utilisateur à la requête
        $data = $request->all();
        $data['user_id'] = Auth::id();
    
        // Créer la catégorie avec les données fournies
        $category = Category::create($data);
    
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

        // Vérifier si l'utilisateur connecté est le créateur de la catégorie
        if ($category->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized to update this category.'], 403);
        }

        $request->validate([
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy($id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['message' => 'Category not found.'], 404);
    }

    // Vérifier si l'utilisateur connecté est le créateur de la catégorie
    if ($category->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized to delete this category.'], 403);
    }

    $category->delete();
    return response()->json(['message' => 'Category deleted successfully.'], 204);
}

    public function showCategoryDetails($id)
    {
        $category = Category::with('themes.cards')->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $themesDetails = $category->themes->map(function ($theme) {
            return [
            'id' => $theme->id,
            'name' => $theme->name,
            'description' => $theme->description,
            'public' => $theme->public,
            'user_id' => $theme->user_id,
            'category_id' => $theme->category_id,
            'cards_count' => $theme->cards->count(),
            'cards' => $theme->cards,
            ];
        });

        return response()->json([
            'category' => $category->name,
            'id' => $category->id,
            'description' => $category->description,
            'created_at' => $category->created_at,
            'updated_at' => $category->updated_at,
            'user_id' => $category->user_id,
            'themes_count' => $category->themes->count(),
            'themes_details' => $themesDetails,
        ]);
    }
}
