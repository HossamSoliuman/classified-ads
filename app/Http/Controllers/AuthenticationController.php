<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAuthRequest;
use App\Http\Requests\UpdateRequest;
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
            'password' => Hash::make($request->validated('password')),
            'email' => $request->validated('email'),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $freePlan = MembershipPlan::find(1);
        Usage::create([
            'user_id' => $user->id,
            'used' => 0,
            'max_limit' => $freePlan->limit,
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
            'Logged in successfully'
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->customResponse([], 'Successfully logged out');
    }

    public function update(UpdateAuthRequest $request)
    {
        $user = $request->user();
        $validated = $request->validated();

        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return $this->customResponse(
            [
                'user' => UserResource::make($user),
            ],
            'User updated successfully'
        );
    }
}
