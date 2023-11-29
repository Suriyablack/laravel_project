<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Http\Requests;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modles\User;

class ProjectController extends Controller
{
    //
    public function register(ProjectRequest $request){
        Project::create([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
        return response('created successfully',201);
    }
    public function login(ProjectRequest $request){
       $credentials = $request->all();
        if(Project::attempt($credentials)){
            $user = Auth::user();
            $token = $user->CreateToken('AuthToken')->accessToken;
            return response()->json(['token =>$token']);
        }
        else{
            Project::create([
            'email' =>$request->get('email'),
            'password' => $request->get('password'),
            ]);
            $token = $request->CreateToken('AuthToken')->accessToken;
            return response('inserted successfully',201);
        }
    }
}
