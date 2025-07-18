<?php
namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {
        return Theme::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'public' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $theme = Theme::create($request->all());
        return response($theme, 201);
    }

    public function show($id)
    {
        // Charger le thème avec ses cartes
        $theme = Theme::with('cards')->find($id);

        if (!$theme) {
            return response()->json(['message' => 'Theme not found.'], 404);
        }

        // Ajouter le nombre de cartes
        $themeData = $theme->toArray();
        $themeData['cards_count'] = $theme->cards->count();

        return response()->json($themeData);
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::find($id);
        $theme->update($request->all());
        return response($theme, 200);
    }

    public function destroy($id)
    {
        Theme::destroy($id);
        return response(null, 204);
    }

    public function duplicate($id)
    {
        // Find the original theme by ID
        $originalTheme = Theme::with('cards')->find($id);

        if (!$originalTheme) {
            return response()->json(['message' => 'Theme not found.'], 404);
        }

        // Duplicate the theme details
        $duplicatedTheme = $originalTheme->replicate();
        $duplicatedTheme->name .= ' (Copy)';
        $duplicatedTheme->duplicated = 1; // Mark as duplicated
        $duplicatedTheme->user_id = Auth::id(); // Set the user ID to the duplicator's ID
        $duplicatedTheme->save();

        // Duplicate the associated cards
        foreach ($originalTheme->cards as $card) {
            $newCard = $card->replicate();
            $newCard->theme_id = $duplicatedTheme->id;
            $newCard->save();
        }

        return response()->json($duplicatedTheme, 201);
    }
}
