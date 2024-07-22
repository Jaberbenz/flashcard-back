<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        return Card::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'front_text' => 'nullable|string',
            'front_image' => 'nullable|string',
            'front_video' => 'nullable|string',
            'front_audio' => 'nullable|string',
            'back' => 'required|string',
            'theme_id' => 'required|exists:themes,id',
        ]);

        $card = Card::create($request->all());

        return response()->json($card, 201);
    }

    public function show($id)
    {
        return Card::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'front_text' => 'nullable|string',
            'front_image' => 'nullable|string',
            'front_video' => 'nullable|string',
            'front_audio' => 'nullable|string',
            'back' => 'required|string',
            'theme_id' => 'required|exists:themes,id',
        ]);

        $card = Card::find($id);
        $card->update($request->all());

        return response()->json($card, 200);
    }

    public function destroy($id)
    {
        $card = Card::find($id);

        if ($card) {
            $card->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Card not found'], 404);
        }
    }
}