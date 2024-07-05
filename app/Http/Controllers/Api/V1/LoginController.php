<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an incoming login request for API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public function store(Request $request){

        $request->validate([
            'email'=>['required','string','email'],
            'password'=>['required','string'],
        ]);

        if(!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'message'=>'Bad credential'
            ],401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'=>'User logged in successfuly',
            'token'=> $token,
            'user'=> $user,
        ]);
     }

     public function currentUser(Request $request){

        return response()->json([
            'message'=>'Logged in user',
            'user'=> $request->user()
        ]);
     }

     /**
     * Revoke the active token.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token revoked successfully',
        ]);
    }
}
