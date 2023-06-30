<?php

namespace App\Http\Controllers;

use App\Models\OfferType;
use App\Http\Requests\StoreOfferTypeRequest;
use App\Http\Requests\UpdateOfferTypeRequest;
use App\Traits\ApiResponse;

class OfferTypeController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offerTypes = OfferType::all();
        return $this->successResponse($offerTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfferTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferTypeRequest $request)
    {
        $offerType = OfferType::create($request->validated());
        return $this->successResponse($offerType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferType  $offerType
     * @return \Illuminate\Http\Response
     */
    public function show(OfferType $offerType)
    {
        return $this->successResponse($offerType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferTypeRequest  $request
     * @param  \App\Models\OfferType  $offerType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferTypeRequest $request, OfferType $offerType)
    {
        $offerType->update($request->validated());
        return $this->successResponse($offerType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferType  $offerType
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferType $offerType)
    {
        $offerType->delete();
        return $this->customResponse([], 'Successfully deleted');
    }
}