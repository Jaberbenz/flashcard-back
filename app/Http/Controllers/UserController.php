<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'daily_reminder' => 'boolean',
            'review_level' => 'integer',
        ]);

        $user = User::create($request->all());
        return response($user, 201);
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response($user, 200);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response(null, 204);
    }
}