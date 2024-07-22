<?php
namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

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
        return Theme::find($id);
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
}
