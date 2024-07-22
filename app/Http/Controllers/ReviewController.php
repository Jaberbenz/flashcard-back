<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'review_date' => 'required|date',
            'max_level' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'theme_id' => 'required|exists:themes,id',
            'level' => 'required|integer',
        ]);

        $review = Review::create($request->all());
        return response($review, 201);
    }

    public function show($id)
    {
        return Review::find($id);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        $request->validate([
            'review_date' => 'required|date',
            'max_level' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'theme_id' => 'required|exists:themes,id',
            'level' => 'required|integer',
        ]);
        $review->update($request->all());
        return response($review, 200);
    }

    public function destroy($id)
    {
        Review::destroy($id);
        return response(null, 204);
    }
}
