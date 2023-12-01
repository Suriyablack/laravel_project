<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\Http;

class UserInfo extends Controller
{
    //
    public function details($token)
    {
        $token = Auth::employees();

        $user = Employees::where('user_id', $token->id)->first();

        if (!$user) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $response = [
            'employees' => $token,
        ];

        return response()->json($response, 200);
    }
}
