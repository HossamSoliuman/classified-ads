<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\AdResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PaginatedResource;
use App\Models\Ad;
use App\Models\Banner;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class CategoryController extends Controller
{
    use ApiResponse, ManagesFiles;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return $this->successResponse($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $image = $this->uploadFile($request->validated('image'), Category::PATH);
        $data = $request->validated();
        $data['image'] = $image;
        $category = Category::create($data);
        return $this->successResponse($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category->load(['subCategories']);

        $ads = Ad::where('category_id', $category->id)
            ->where('status', Ad::PUBLISHED)
            ->paginate(16);
        $category->ads = $ads;

        return $this->successResponse([
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $image = $request->validated('image');
        if ($image) {
            $this->deleteFile($category->image);
            $imgagePath = $this->uploadFile($image, Category::PATH);
            $data['image'] = $imgagePath;
        }
        $category->update($data);

        return $this->successResponse($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->deleteFile($category->image);
        if ($category->banner)
            $this->deleteFile($category->banner->image);
        $category->banner()->delete();
        $category->delete();
        return $this->customResponse([], 'Successfully deleted');
    }

    public function posts(Category $category)
    {
        $category->load(['posts' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->paginate(10);

        return $this->successResponse(
            CategoryResource::make($category)
        );
    }
    public function featuredAds($category)
    {
        $ads = Ad::where('category_id', $category)
            ->where('status', Ad::PUBLISHED)
            ->where('featured', Ad::CATEGORY_FEATURED)
            ->get();
        return $this->successResponse(AdResource::collection($ads));
    }
    public function banners($category)
    {
        $banners = Banner::where('type', Banner::CATEGORY_TYPE)->where('parent_id', $category)->get();
        return $this->successResponse($banners);
    }
}

