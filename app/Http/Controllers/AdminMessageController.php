<?php

namespace App\Http\Controllers;

use App\Models\AdminMessage;
use App\Http\Requests\StoreAdminMessageRequest;
use App\Http\Requests\UpdateAdminMessageRequest;
use App\Models\AdminMessageUser;
use App\Models\User;
use App\Traits\ApiResponse;

class AdminMessageController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = AdminMessage::paginate();
        return $this->successResponse($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminMessageRequest $request)
    {
        $validatedData = $request->validated();
        $message = AdminMessage::create([
            'message' => $validatedData['message'],
        ]);
        $userIds = $validatedData['users'] ?? User::pluck('id');
        $message->users()->attach($userIds);
        return $this->successResponse($message);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminMessage  $adminMessage
     * @return \Illuminate\Http\Response
     */
    public function show(AdminMessage $adminMessage)
    {
        // Eager load the related users
        $adminMessage->load('users');

        // Remove the pivot data from the admin message
        $adminMessage->unsetRelation('pivot');

        return $this->successResponse($adminMessage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminMessageRequest  $request
     * @param  \App\Models\AdminMessage  $adminMessage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminMessageRequest $request, AdminMessage $adminMessage)
    {
        $adminMessage->update($request->validated());
        return $this->successResponse($adminMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminMessage  $adminMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminMessage $adminMessage)
    {
        $adminMessage->delete();
        return $this->customResponse([], 'deleted');
    }
}
