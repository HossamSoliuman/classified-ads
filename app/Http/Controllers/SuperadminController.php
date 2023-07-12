<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
class SuperadminController extends Controller
{
    use ApiResponse;
    public function setAdmin(User $user){
        $user->update([
            'role'=>'admin',
        ]);
        return $this->successResponse($user);
    }
    public function unsetAdmin(User $user){
        $user->update([
            'role'=>'user',
        ]);
        return $this->successResponse($user);
    }
}
