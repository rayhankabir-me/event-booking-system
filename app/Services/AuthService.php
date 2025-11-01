<?php

namespace App\Services;

use App\Enum\UserRoleEnum;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    
    public function register(RegisterRequest $request) {
        try {
            $user = User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'role'              => $request->role ?? UserRoleEnum::CUSTOMER,
                'password'          => Hash::make($request->password),
            ]);
            return $user;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }
}
