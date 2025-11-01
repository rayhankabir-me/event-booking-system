<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) : Response | UserResource {

        try {
            return new UserResource($this->authService->register($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function login(LoginRequest $request) {

        if(!Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])) {
            return response()->json(['status' => false,'message'=>'Invalid credentials'],401);
        }
        $user = Auth::user();
        $token = $user->createToken('access_token')->plainTextToken;
        return response()->json(['status' => true, 'user'=> new UserResource($user),'token'=>$token]);
    }

    public function me(Request $request) {
        return new UserResource($request->user());
    }

    public function logout(Request $req){
        $req->user()->currentAccessToken()->delete();
        return response()->json(['status' => true, 'message'=>'Logged out']);
    }

}

