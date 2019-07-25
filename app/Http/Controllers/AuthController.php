<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('register', 'login');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z0-9\-_#]*$/|unique:users|max:255',
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
            'login' => 'required|max:255',
            'password' => 'required|between:8,48'
        ]);

        $user = User::where('name', '=', $request->login)->orWhere('email', '=', $request->login)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->update(['api_token' => \Str::random(60)]);

            return [
                'success' => true,
                'user' => $user->info()
            ];
        }

        return [
            'errors' => [
                'login' => ['Login or password is wrong!']
            ],
            'status' => 422
        ];
    }

    public function verify(){
        $user = Auth::user();

        return [
            'success' => true,
            'user' => $user->info()
        ];
    }

    public function logout(){
        $user = Auth::user();

        $user->update(['api_token' => null]);

        return [
            'success' => true,
        ];
    }
}
