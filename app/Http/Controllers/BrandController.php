<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class BrandController extends Controller
{
    use ApiResponse,ManagesFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::paginate(8);
        return $this->successResponse($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $image=$this->uploadFile($request->validated('image'),Brand::PATH);
        $data=$request->validated();
        $data['image']=$image;
        $brand=Brand::create($data);
        return $this->successResponse($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return $this->successResponse($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $image=$request->validated('image');
        $data=$request->validated();
        if($image){
            $this->deleteFile($brand->image);
            $this->uploadFile($image,Brand::PATH);
            $data['image']=$image;
        }
        $brand->update($data);
        return $this->successResponse($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->deleteFile($brand->image);
        $brand->delete();
        return $this->customResponse([],'deleted');
    }
}
