<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use App\Http\Requests\StoreUnitTypeRequest;
use App\Http\Requests\UpdateUnitTypeRequest;
use App\Traits\ApiResponse;

class UnitTypeController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitTypes = UnitType::all();
        return $this->successResponse($unitTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnitTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitTypeRequest $request)
    {
        $unitType = UnitType::create($request->validated());
        return $this->successResponse($unitType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function show(UnitType $unitType)
    {
        return $this->successResponse($unitType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitTypeRequest  $request
     * @param  \App\Models\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitTypeRequest $request, UnitType $unitType)
    {
        $unitType->update($request->validated());
        return $this->successResponse($unitType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitType $unitType)
    {
        $unitType->delete();
        return $this->customResponse([], 'Successfully deleted');
    }
}