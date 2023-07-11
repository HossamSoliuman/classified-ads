<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\UserResource;
use App\Models\MembershipPlan;
use App\Models\Usage;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'password'=>Hash::make($request->validated('password')),
            'email'=>$request->validated('email'),
            
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $freePlan=MembershipPlan::find(1);
        Usage::create([
            'user_id'=>$user->id,
            'used'=>0,
            'max_limit'=>$freePlan->limit,
        ]);

        return $this->customResponse(
            [
                'token' => $token,
                'user' => RegisterResource::make($user),
            ],
        );
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return $this->errorResponse('Email or password is wrong', 401);
        }

        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->customResponse(
            [
                'token' => $token,
                'user' => UserResource::make($user),

            ],
           'Logedin Succussfully'
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->customResponse([],'Succussfully loged out');
    }
}