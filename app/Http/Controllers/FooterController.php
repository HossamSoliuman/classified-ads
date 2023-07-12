<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Http\Requests\StoreFooterRequest;
use App\Http\Requests\UpdateFooterRequest;
use App\Http\Resources\FooterResource;
use App\Traits\ApiResponse;

class FooterController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footers=Footer::all();
        return $this->successResponse(FooterResource::collection($footers));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFooterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFooterRequest $request)
    {
        $footer=Footer::create($request->validated());
        return $this->successResponse(FooterResource::make($footer));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function show(Footer $footer)
    {
        return $this->successResponse(FooterResource::make($footer));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFooterRequest  $request
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFooterRequest $request, Footer $footer)
    {
        $data['content']=  $request->validated('content');
        $footer->update();
        return $this->successResponse(FooterResource::make($footer) );


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Footer $footer)
    {
        $footer->delete();
        return $this->customResponse([],'deleted');
    }
}
