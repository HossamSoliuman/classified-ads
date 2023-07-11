<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class BannerController extends Controller
{
    use ApiResponse, ManagesFiles;
    /**
     * Display a listing of the resource.
     *2
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::paginate(10);
        return $this->successResponse($banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $image = $this->uploadFile($request->validated('image'), Banner::PATH);
        $data = $request->validated();
        $data['image'] = $image;
        $banner = Banner::create($data);
        return $this->successResponse($banner);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        if ($banner->type == Banner::CATEGORY_TYPE)
            $banner->load('category');

        if ($banner->type == Banner::SUBCATEGORY_TYPE)
            $banner->load('subcategory');

        return $this->successResponse($banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $image = $request->validated('image');
        $data = $request->validated();
        if ($image) {
            $this->deleteFile($banner->image);
            $this->uploadFile($image, Banner::PATH);
            $data['image'] = $image;
        }
        $banner->update($data);
        return $this->successResponse($banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $this->deleteFile($banner->image);
        $banner->delete();
        return $this->customResponse([], 'deleted');
    }
}
