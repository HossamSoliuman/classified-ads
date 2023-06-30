<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use App\Http\Requests\StorePriceTypeRequest;
use App\Http\Requests\UpdatePriceTypeRequest;
use App\Traits\ApiResponse;

class PriceTypeController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceTypes = PriceType::all();
        return $this->successResponse($priceTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePriceTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceTypeRequest $request)
    {
        $priceType = PriceType::create($request->validated());
        return $this->successResponse($priceType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function show(PriceType $priceType)
    {
        return $this->successResponse($priceType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePriceTypeRequest  $request
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriceTypeRequest $request, PriceType $priceType)
    {
        $priceType->update($request->validated());
        return $this->successResponse($priceType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceType $priceType)
    {
        $priceType->delete();
        return $this->customResponse([], 'Successfully deleted');
    }
}