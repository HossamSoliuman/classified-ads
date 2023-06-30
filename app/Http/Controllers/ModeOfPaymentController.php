<?php

namespace App\Http\Controllers;

use App\Models\ModeOfPayment;
use App\Http\Requests\StoreModeOfPaymentRequest;
use App\Http\Requests\UpdateModeOfPaymentRequest;
use App\Traits\ApiResponse;

class ModeOfPaymentController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modesOfPayment = ModeOfPayment::all();
        return $this->successResponse($modesOfPayment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModeOfPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModeOfPaymentRequest $request)
    {
        $modeOfPayment = ModeOfPayment::create($request->validated());
        return $this->successResponse($modeOfPayment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModeOfPayment  $modeOfPayment
     * @return \Illuminate\Http\Response
     */
    public function show(ModeOfPayment $modeOfPayment)
    {
        return $this->successResponse($modeOfPayment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModeOfPaymentRequest  $request
     * @param  \App\Models\ModeOfPayment  $modeOfPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModeOfPaymentRequest $request, ModeOfPayment $modeOfPayment)
    {
        $modeOfPayment->update($request->validated());
        return $this->successResponse($modeOfPayment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModeOfPayment  $modeOfPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModeOfPayment $modeOfPayment)
    {
        $modeOfPayment->delete();
        return $this->customResponse([], 'Successfully deleted');
    }
}