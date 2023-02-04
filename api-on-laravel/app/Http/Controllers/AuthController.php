<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function isLoaded() {
        return response('isLoaded');
    }
    // * Method: POST
    // ! Route: /api/start-game
    // ? Just User
    public function create (Request $request) {
        $request->validate([
            'name|min:1',
            'country|min:2',
            'image'
        ]);

        $image = $request->image;
        
        if ($image) {
            $imageName = Str::random(32).'.'.$request->image->getClientOriginalExtension();

            $path = public_path('files/');
            $image->move($path, $imageName);

            $imageField = $imageName;
        } else {
            $imageField = '';
        }

        $user = User::create([
            'name' => $request->name,
            'country' => $request->country,
            'image' => $imageField
        ]);

        $user->save();

        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
}
