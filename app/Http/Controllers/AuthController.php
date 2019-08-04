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

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'regex:/^[a-zA-Z0-9\-_#]*$/|max:255|nullable',
            'email' => 'email|nullable',
            'password' => 'between:6,48|nullable',
            'old_password' => 'required|between:6,48'
        ], [], [
            'old_password' => 'текущий пароль'
        ]);

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response([
                'message' => 'Wrong password',
                'errors' => ['old_password' => 'Неверный пароль']
            ], 422);
        }

        $data = [
            'name' => $request->input('name') ?: $user->name,
            'email' => $request->input('email') ?: $user->email,
            'password' => $request->input('password') === null ? $user->password : Hash::make($request->input('password')),
        ];

        $user->update($data);

        return [
            'success' => true,
            'user' => $user->info()
        ];
    }

    public function verify()
    {
        $user = Auth::user();

        return [
            'success' => true,
            'user' => $user->info()
        ];
    }

    public function logout()
    {
        $user = Auth::user();

        $user->update(['api_token' => null]);

        return [
            'success' => true,
        ];
    }
}
