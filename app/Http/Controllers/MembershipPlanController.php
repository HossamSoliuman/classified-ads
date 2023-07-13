<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Http\Requests\StoreMembershipPlanRequest;
use App\Http\Requests\UpdateMembershipPlanRequest;
use App\Traits\ApiResponse;

class MembershipPlanController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans=MembershipPlan::all();
        return $this->successResponse($plans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMembershipPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipPlanRequest $request)
    {
        $plan=MembershipPlan::create($request->validated());
        return $this->successResponse($plan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MembershipPlan  $membershipPlan
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipPlan $membershipPlan)
    {
        return $this->successResponse($membershipPlan);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembershipPlanRequest  $request
     * @param  \App\Models\MembershipPlan  $membershipPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipPlanRequest $request, MembershipPlan $membershipPlan)
    {
        $membershipPlan->update($request->validated());
        return $this->successResponse($membershipPlan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MembershipPlan  $membershipPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipPlan $membershipPlan)
    {
        if($membershipPlan->id==1){
            return $this->errorResponse('You cant delete default plan',400);
        }
        $membershipPlan->delete();
        return $this->customResponse([],'deleted');
    }
}
