<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function user()
    {
        return (new RegisterResource(auth()->user()));
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        // auth()->user()->tokens()->delete();
        $request->user()->tokens()->delete();
        return response()->json([
            'mesage' => 'logged out'
        ], 200);
    }
}
