<?php

namespace App\Http\Controllers;

use App\Models\ServiceEnquiry;
use App\Http\Requests\StoreServiceEnquiryRequest;
use App\Http\Requests\UpdateServiceEnquiryRequest;
use App\Traits\ApiResponse;

class ServiceEnquiryController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = ServiceEnquiry::orderBy('id', 'desc')->paginate(10);
        return $this->successResponse($enquiries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceEnquiryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceEnquiryRequest $request)
    {
        $enquiry = ServiceEnquiry::create($request->validated());

        return $this->successResponse($enquiry);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceEnquiry  $serviceEnquiry
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEnquiry $serviceEnquiry)
    {
        return $this->successResponse($serviceEnquiry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceEnquiryRequest  $request
     * @param  \App\Models\ServiceEnquiry  $serviceEnquiry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceEnquiryRequest $request, ServiceEnquiry $serviceEnquiry)
    {
        $serviceEnquiry->update($request->validated());

        return $this->successResponse($serviceEnquiry);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceEnquiry  $serviceEnquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEnquiry $serviceEnquiry)
    {
        $serviceEnquiry->delete();

        return $this->customResponse(null, 'Enquiry deleted successfully');
    }
}
