<?php

namespace App\Http\Controllers;

use App\Models\CareerEnquire;
use App\Http\Requests\StoreCareerEnquireRequest;
use App\Http\Requests\UpdateCareerEnquireRequest;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class CareerEnquireController extends Controller
{
    use ApiResponse,ManagesFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquires=CareerEnquire::orderBy('id','desc')->get();
        return $this->successResponse($enquires);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCareerEnquireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCareerEnquireRequest $request)
    {
        $data=$request->validated();
        $data['resume']=$this->uploadFile($request->validated('resume'),CareerEnquire::PATH);
        $enquire=CareerEnquire::create($data);
        return $this->successResponse($enquire);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CareerEnquire  $careerEnquire
     * @return \Illuminate\Http\Response
     */
    public function show(CareerEnquire $careerEnquire)
    {
        return $this->successResponse($careerEnquire);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareerEnquire  $careerEnquire
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareerEnquire $careerEnquire)
    {
        $this->deleteFile($careerEnquire->resume);
        $careerEnquire->delete();
        return $this->customResponse([],'deleted');
    }
}
