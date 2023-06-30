<?php

namespace App\Http\Controllers;

use App\Models\ReturnPolicy;
use App\Http\Requests\StoreReturnPolicyRequest;
use App\Http\Requests\UpdateReturnPolicyRequest;
use App\Traits\ApiResponse;

class ReturnPolicyController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returnPolicies = ReturnPolicy::all();
        return $this->successResponse($returnPolicies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReturnPolicyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnPolicyRequest $request)
    {
        $returnPolicy = ReturnPolicy::create($request->validated());
        return $this->successResponse($returnPolicy);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnPolicy  $returnPolicy
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnPolicy $returnPolicy)
    {
        return $this->successResponse($returnPolicy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnPolicyRequest  $request
     * @param  \App\Models\ReturnPolicy  $returnPolicy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnPolicyRequest $request, ReturnPolicy $returnPolicy)
    {
        $returnPolicy->update($request->validated());
        return $this->successResponse($returnPolicy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnPolicy  $returnPolicy
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnPolicy $returnPolicy)
    {
        $returnPolicy->delete();
        return $this->customResponse([], 'Successfully deleted');
    }
}