<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Casts\Json;

class UserController extends Controller
{
    public function register(Request $request): JsonResponse
    {

        $validateUser = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1',
            'pincode' => 'required|numeric|min:6',
        ]);
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'errors' => $validateUser->errors()->all(),
            ], 401);

        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'address' => $request->address,
                'status' => $request->status,
                'pincode' => $request->pincode,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User created Successfully',
                'user' => new UserResource($user),
            ], 201);
        }

    }

    public function login(Request $request): JsonResponse
    {
        $validateUser = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'errors' => $validateUser->errors()->all(),
            ], 401);

        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $authUser = Auth::user();
                return response()->json([
                    'status' => true,
                    'message' => 'User Login Successfully',
                    'token' => $authUser->createToken("apiToken")->plainTextToken,
                    'token_type' => 'bearer'
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User Authentication failed',
                ], 401);
            }


        }
    }
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User Loged Out Successfully',
            'user' => new UserResource($user),
        ], 200);
    }
}
