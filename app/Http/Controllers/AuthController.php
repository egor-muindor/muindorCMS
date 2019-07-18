<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:6,48|confirmed'
        ]);

        $user = new User($request->all());
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return ['success' => true];
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required_without:email|max:255',
            'email' => 'required_without:name|max:255',
            'password' => 'required|between:8,48'
        ]);

        if ($request->input('name')) {
            $user = User::whereName($request->name)->first();
        } else {
            $user = User::whereEmail($request->email)->first();
        }

        if ($user && Hash::check($request->password, $user->password)) {
            $user->update(['api_token' => \Str::random(100)]);

            return [
                'success' => true,
                'user' => $user->info()
            ];
        }

        return [
            'errors' => [
                'login' => 'Login failed'
            ],
            'status' => 422
        ];


    }
}
