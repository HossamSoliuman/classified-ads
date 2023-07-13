<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use App\Models\Banner;
use App\Traits\ApiResponse;

class SubCategoryController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::paginate(10);
        return $this->successResponse($subCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $subCategory = SubCategory::create($request->validated());
        return $this->successResponse($subCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        $ads = Ad::where('sub_category_id', $subCategory->id)
            ->where('status', Ad::PUBLISHED)
            ->paginate(8);
        $subCategory->ads = $ads;
        return $this->successResponse($subCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubCategoryRequest  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update($request->validated());
        return $this->successResponse($subCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        if ($subCategory->banner)
            $this->deleteFile($subCategory->banner->image);
        $subCategory->banner()->delete();
        return $this->customResponse([], 'Successfully deleted');
    }
    public function featuredAds($sub_category)
    {
        $ads = Ad::where('sub_category_id', $sub_category)
            ->where('status', Ad::PUBLISHED)
            ->where('featured', Ad::SUPCATEGORY_FEATURED)
            ->get();
        return $this->successResponse(AdResource::collection($ads));
    }
    public function banners($sub_category)
    {
        $banners = Banner::where('type', Banner::SUBCATEGORY_TYPE)->where('parent_id', $sub_category)->get();
        return $this->successResponse($banners);
    }
}
