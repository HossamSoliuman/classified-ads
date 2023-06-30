<?php

namespace App\Http\Controllers;

use App\Models\OrderType;
use App\Http\Requests\StoreOrderTypeRequest;
use App\Http\Requests\UpdateOrderTypeRequest;
use App\Traits\ApiResponse;

class OrderTypeController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderTypes = OrderType::all();
        return $this->successResponse($orderTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderTypeRequest $request)
    {
        $orderType = OrderType::create($request->validated());
        return $this->successResponse($orderType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderType  $orderType
     * @return \Illuminate\Http\Response
     */
    public function show(OrderType $orderType)
    {
        return $this->successResponse($orderType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderTypeRequest  $request
     * @param  \App\Models\OrderType  $orderType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderTypeRequest $request, OrderType $orderType)
    {
        $orderType->update($request->validated());
        return $this->successResponse($orderType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderType  $orderType
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderType $orderType)
    {
        $orderType->delete();
        return $this->customResponse([], 'Successfully deleted');
    }
}