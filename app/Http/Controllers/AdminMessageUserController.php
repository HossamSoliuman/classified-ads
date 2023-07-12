<?php

namespace App\Http\Controllers;

use App\Models\AdminMessageUser;
use App\Http\Requests\StoreAdminMessageUserRequest;
use App\Http\Requests\UpdateAdminMessageUserRequest;

class AdminMessageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminMessageUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminMessageUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminMessageUser  $adminMessageUser
     * @return \Illuminate\Http\Response
     */
    public function show(AdminMessageUser $adminMessageUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminMessageUserRequest  $request
     * @param  \App\Models\AdminMessageUser  $adminMessageUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminMessageUserRequest $request, AdminMessageUser $adminMessageUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminMessageUser  $adminMessageUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminMessageUser $adminMessageUser)
    {
        //
    }
}
