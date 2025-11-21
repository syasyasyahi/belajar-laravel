<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function actionLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            // status : 2 (success), 4(failed), 500(error from database), 404 or 4 (failed from browser)
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $credentials = $request->only('email', 'password');
            if (!$token = Auth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = Auth::user();
            $create_token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $create_token, 'token_type' => 'bearer']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function me()
    {
        $user = Auth::guard('api')->user();
        return response()->json(['message' => 'Me success', 'data' => $user]);
    }
}
