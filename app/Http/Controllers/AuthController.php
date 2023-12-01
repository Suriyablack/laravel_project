<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTProvider;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        Employees::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'active' => $request->get('active'),

        ]);
        return response()->json(['Data' => 'Data Insertes successully'], 201);
    }

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $user = employees::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {

            $token = $this->generateToken($user);
            return response()->json(['token' => $token], 201);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 404);
        }
    }

    public function generateToken($user)
    {
        $secretKey = 'XAFB5vpQGuEgQjhZLwLlHtybRuIDhHvtFNuHVtbsvNYYuCq3RHgK6zyIj63uZulA';

        $payload = [
            'iss' => 'Postman api',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60,
        ];

        $token = JWTProvider::encode($payload, $secretKey, 'HS256');


        return $token;
    }

    public function userInfo(Request $request)
    {
        $token = $request->header('authorization');

        try {

            $payload = JWTProvider::decode($token);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Invalid token']);
        }

        $userId = $payload;

        $userData = Employees::find($userId);

        if (!$userData) {
            return response()->json(['error' => 'User Not Found']);
        }
        return response()->json(['data' => $userData]);
    }
}
