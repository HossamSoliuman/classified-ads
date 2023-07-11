<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Membership;
use App\Models\Usage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class UserController extends Controller
{
    use ApiResponse, ManagesFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $users = User::paginate($request->query('per_page', 3));
        return $this->successResponse([
            'users' => UserResource::collection($users),
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'next_page_url' => $users->nextPageUrl(),
                'prev_page_url' => $users->previousPageUrl(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
            ]
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->successResponse(UserResource::make($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = User::find(auth()->id());
        if ($request->validated('img')) {
            $this->deleteFile($user->image);
            $image = $this->uploadFile($request->validated('img'), User::PATH);
            $user->update(['image' => $image]);
        }
        $user->update($request->validated());
        return $this->successResponse(UserResource::make($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->deleteFile($user->image);
        $user->delete();
        return $this->customResponse(null, 'User Deleted');
    }
    public function auth()
    {
        $user = auth()->user();
        return $this->successResponse(UserResource::make($user));
    }
    public function authUsage()
    {
        $usage = Usage::where('user_id', auth()->id())->get();
        return $this->successResponse($usage);
    }
    public function usage(User $user)
    {
        $usage = Usage::where('user_id', $user->id)->get();
        return $this->successResponse($usage);
    }
    public function memberships(User $user)
    {
        $user->load('memberships');
        $memberships = $user->memberships;
        return $this->successResponse($memberships);
    }
    public function authMemberships(){
        $memberships=Membership::with('MembershipPlan')->where('user_id',auth()->id())->get();
        return $this->successResponse($memberships);
    }
}
