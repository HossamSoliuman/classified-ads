<?php

namespace App\Http\Controllers;

use App\Models\AdEnquir;
use App\Http\Requests\StoreAdEnquirRequest;
use App\Http\Requests\UpdateAdEnquirRequest;
use App\Models\Ad;
use App\Traits\ApiResponse;

class AdEnquirController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquires = AdEnquir::orderBy('id', 'desc')->paginate(10);
        return $this->successResponse($enquires);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdEnquirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdEnquirRequest $request)
    {
        $data = $request->validated();
        $data['sender_id'] = auth()->id();
        $ad = Ad::where('id', $data['ad_id'])->get(['user_id'])->first();
        $data['ad_owner_id'] = $ad->user_id;
        $adEnquire = AdEnquir::create($data);
        return $this->successResponse($adEnquire);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdEnquir  $adEnquir
     * @return \Illuminate\Http\Response
     */
    public function show(AdEnquir $adEnquire)
    {
        $admin = auth()->user()->role == 'admin';
        $reciever = auth()->id() == $adEnquire->ad_owner_id;
        if ($admin || $reciever) {
            $adEnquire->load(['adOwner', 'ad', 'sender']);
            return $this->successResponse($adEnquire);
        }
        return $this->customResponse([], 'unauthorized', 401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdEnquirRequest  $request
     * @param  \App\Models\AdEnquir  $adEnquir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdEnquirRequest $request, AdEnquir $adEnquir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdEnquir  $adEnquir
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdEnquir $adEnquire)
    {
        $admin = auth()->user()->role == 'admin';
        $reciever = auth()->id() == $adEnquire->ad_owner_id;
        if ($admin || $reciever) {
            $adEnquire->delete();
            return $this->customResponse([], 'deleted');
        }
        return $this->customResponse([], 'unauthorized', 401);
    }
}
