<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Requests\UpdateBoxRequest;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class BoxController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxes = Box::all();
        return $this->successResponse($boxes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoxRequest $request)
    {
        $validatedData = $request->validated();
        $box = Box::create($validatedData);
        return $this->successResponse($box);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        return $this->successResponse($box);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoxRequest  $request
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoxRequest $request, Box $box)
    {
        $validatedData = $request->validated();
        $box->update($validatedData);
        return $this->successResponse($box);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {
        $box->delete();
        return $this->customResponse([], 'Box deleted successfully.');
    }
}