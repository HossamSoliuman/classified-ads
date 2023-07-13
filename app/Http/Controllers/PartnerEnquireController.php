<?php

namespace App\Http\Controllers;

use App\Models\PartnerEnquire;
use App\Http\Requests\StorePartnerEnquireRequest;
use App\Http\Requests\UpdatePartnerEnquireRequest;
use App\Traits\ApiResponse;

class PartnerEnquireController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PartnerEnquires=PartnerEnquire::orderBy('id','desc')->paginate();
        return $this->successResponse($PartnerEnquires);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnerEnquireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerEnquireRequest $request)
    {
        $partnerEnquire=PartnerEnquire::create($request->validated());
        return $this->successResponse($partnerEnquire);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnerEnquire  $partnerEnquire
     * @return \Illuminate\Http\Response
     */
    public function show(PartnerEnquire $partnerEnquire)
    {
        return $this->successResponse($partnerEnquire);
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartnerEnquire  $partnerEnquire
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnerEnquire $partnerEnquire)
    {
        $partnerEnquire->delete();
        return $this->customResponse([],'deleted');
    }
}
