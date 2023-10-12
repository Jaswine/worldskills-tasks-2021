<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    # Login
    public function login(LoginRequest $request) {
        // Check auth
        if (!auth()->check()) {
            # if u aren't auth chek username and password
            if (Auth::attempt($request->only(['username','password' ]))) {

                # get user
                $user = User::where('username', $request->username)->first();

                #generate token
                $user->accessToken = Hash::make($request->username);
                $user->save();
    
                # return token
                return response()->json([
                    'token' => $user->accessToken,
                ], 200);
            } else {
                # Invalid credentials
                return response()->json(['message' => 'Invalid credentials'], 400);
            }
        }
    }

    # Registration 
    public function register(LoginRequest $request) {
        $request->validated($request->all());

        # check username
        if (User::where('username', $request->username)->first()) {
            return response([
                'status' => 'error',
                'message' => 'username already registered'
            ], 403);
        }

        # create user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'accessToken' => Hash::make($request->username)
        ]);
        
        # response
        return response([
            'token' => $user->accessToken
        ], 200);
    }

    # Logout 
    public function logout(Request $request) {
        # auth checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        if (!$user) {
            return response()->json(['message' => 'Invalid Token'], 403);   
        }
        # delete access Token
        $user -> accessToken = "";
        $user -> save();

        # response message
        return response()->json([
            'message' => 'logout successfully'
        ], 200);
    }
}
