<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionRequest;
use App\Http\Requests\StoreSubscriptionRequestRequest;
use App\Http\Requests\UpdateSubscriptionRequestRequest;
use App\Traits\ApiResponse;

class SubscriptionRequestController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptionRequests = SubscriptionRequest::with('user')->orderBy('id', 'desc')->paginate(10);
        return $this->successResponse($subscriptionRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriptionRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequestRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $subscriptionRequest = SubscriptionRequest::create($data);
        return $this->successResponse($subscriptionRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionRequest  $subscriptionRequest
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionRequest $subscriptionRequest)
    {
        $subscriptionRequest->load('user');
        return $this->successResponse($subscriptionRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionRequestRequest  $request
     * @param  \App\Models\SubscriptionRequest  $subscriptionRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequestRequest $request, SubscriptionRequest $subscriptionRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionRequest  $subscriptionRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionRequest $subscriptionRequest)
    {
        $subscriptionRequest->delete();
        return $this->customResponse('deleted');
    }
}
