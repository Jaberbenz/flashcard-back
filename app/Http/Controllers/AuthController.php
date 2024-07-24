<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Méthode pour l'inscription des utilisateurs
    public function register(Request $request)
    {
        // Valider les données de l'inscription
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Créer un nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Générer un token d'accès pour l'utilisateur
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // Retourner la réponse avec les informations de l'utilisateur et le token
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }
    

    public function authenticate(Request $request) 
    {
        // Trouver l'utilisateur par e-mail
        $user = User::where('email', $request->email)->first();
    
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Créer un token d'authentification pour l'utilisateur
            $token = $user->createToken('auth_token')->plainTextToken;
    
            // Renvoyer les informations de l'utilisateur et le token
            return response()->json([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    // Ajoutez d'autres informations utilisateur si nécessaire
                ],
                'token' => $token,
            ]);
        } else {
            // Répondre avec une erreur si les identifiants sont incorrects
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }


    public function dashboard()
    {
        return response()->json([
            'message' => 'You are in the dashboard'
        ]);
    }

    // Méthode pour la déconnexion des utilisateurs
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
