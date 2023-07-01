<?php

namespace App\Http\Controllers;

use App\Models\OurServiceEnquiry;
use App\Http\Requests\StoreOurServiceEnquiryRequest;
use App\Http\Requests\UpdateOurServiceEnquiryRequest;
use App\Traits\ApiResponse;

class OurServiceEnquiryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries=OurServiceEnquiry::orderBy('id','desc')->paginate(10);
        return $this->successResponse($enquiries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOurServiceEnquiryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOurServiceEnquiryRequest $request)
    {
        $enquiry=OurServiceEnquiry::create($request->validated());
        return $this->successResponse($enquiry);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurServiceEnquiry  $ourServiceEnquiry
     * @return \Illuminate\Http\Response
     */
    public function show(OurServiceEnquiry $ourServiceEnquiry)
    {
        return $this->successResponse($ourServiceEnquiry);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOurServiceEnquiryRequest  $request
     * @param  \App\Models\OurServiceEnquiry  $ourServiceEnquiry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOurServiceEnquiryRequest $request, OurServiceEnquiry $ourServiceEnquiry)
    {
        $ourServiceEnquiry->update($request->validated());
        return $this->successResponse($ourServiceEnquiry);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurServiceEnquiry  $ourServiceEnquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurServiceEnquiry $ourServiceEnquiry)
    {
        $ourServiceEnquiry->delete();
        return $this->customResponse([],'deleted');
    }
}
