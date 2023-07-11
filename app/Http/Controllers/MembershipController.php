<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Ad;
use App\Models\MembershipPlan;
use App\Models\Usage;
use App\Traits\ApiResponse;
use Carbon\Carbon;

class MembershipController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memberships = Membership::with(['user', 'plan'])->get();
        return $this->successResponse($memberships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMembershipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipRequest $request)
    {
        $plan = MembershipPlan::find($request->validated('membership_plan_id'));

        $data = $request->validated();
        $data['starts_at'] = Carbon::now();
        $data['ends_at'] = Carbon::now()->addDays($plan->duration);
        $data['limit'] = $plan->limit;

        $membership = Membership::create($data);

        $membership->load(['user', 'MembershipPlan']);

        $user_id = $request->validated('user_id');
        $userUsage = Usage::where('user_id', $user_id)->first();

        if ($userUsage) {
            $userUsage->update([
                'max_limit' => $userUsage->max_limit + $plan->limit,
            ]);
        }
        return $this->successResponse($membership);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        return $this->successResponse($membership);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembershipRequest  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership->update($request->validated());
        return $this->successResponse($membership);
    }

    /**
     * Remove the specified resource from storage.
     *used 5 max 3 ---> 2
     *used 4 max 5 --->-1

     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        $user_id = $membership->user_id;
        $usage = Usage::where('user_id', $user_id)->get();
        $usage->update([
            'max_limit' => $usage->max_limit - $membership->limit,
        ]);
        $overflow_ads = $usage->used - $usage->max_limit;
        if (!$overflow_ads) {
            for ($i = 0; $i < $overflow_ads; $i++) {
                $published_ad = Ad::where('status', Ad::PUBLISHED)
                    ->where('user_id', $user_id)->get();
                $published_ad->update([
                    'status' => Ad::SUSPENDED,
                ]);
            }
        }
        $membership->delete();
        if (!$overflow_ads > -1) {
            $overflow_ads = 0;
        }
        return $this->successResponse([
            'overflow_ads' => $overflow_ads,
        ]);
    }
}
