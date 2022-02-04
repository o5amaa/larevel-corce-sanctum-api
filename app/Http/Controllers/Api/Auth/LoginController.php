<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {

        // $cre = $request->only(['email','password']);

        // if (!$token = Auth::attempt($cre)) {
        //     return response()->json(['error'=> 'Unauthenticated'],401);
        // }

        // return (new RegisterResource(auth()->user()))->additional([
        //         'meta' => [
        //             'token' => $token,
        //         ]
        //     ]);


        // Chek email
        $user = User::where('email', $request['email'])->first();

        //Chak password
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Bsd creds'
            ], 401);
        }

        if (!$user || !Hash::check($request['password'], $user->password)) {
            // return response(['mesage'=> 'Bad creds']);
            return response()->json(['mesage' => 'Bad creds'], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;


        return (new RegisterResource($user))->additional([
            'meta' => [
                'token' => $token,
            ]
        ]);
    }
}
