<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    public function settings(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'		=>	'required|max:255',
            'username'	=>	'required|max:255|unique:users,username,'.$user->id,
            'email'		=>	'required|email|max:255|unique:users,email,'.$user->id,
            'password'	=>	'nullable|max:255',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return new UserResource($user);
    }
}
