<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\AdResource;
use App\Models\ProductImage;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;
use Illuminate\Http\Request;

class AdController extends Controller
{
    use ApiResponse, ManagesFiles;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ads = Ad::paginate($request->query('per_page', 15));
        return $this->successResponse([
            'data' => AdResource::collection($ads),
            'pagination' => [
                'current_page' => $ads->currentPage(),
                'last_page' => $ads->lastPage(),
                'per_page' => $ads->perPage(),
                'total' => $ads->total(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        $ad = Ad::create($request->validated());
        $images = $request->validated('images');
        if ($images) {
            foreach ($images as $image) {
                $path = $this->uploadFile($image, Ad::PATH);
                ProductImage::create([
                    'ad_id' => $ad->id,
                    'path' => $path,
                ]);
            }
        }
        return $this->successResponse(AdResource::make($ad));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        
        return $this->successResponse(AdResource::make($ad));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdRequest  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        if (auth()->id() != $ad->user_id) {
            return $this->errorResponse('you cant update this ad', 401);
        }
        $ad->update($request->validated());
        return $this->successResponse(AdResource::make($ad));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        if (auth()->id() != $ad->user_id) {
            return $this->errorResponse('you cant delete this ad', 401);
        }
        $ad->delete();
        return $this->customResponse([], 'succussfully deleted');
    }
    public function setAdFeatured($ad_id){
        $ad=Ad::find($ad_id);
        $ad->update([
            'featured'=>1,
        ]);
        return $this->successResponse($ad);
    }
    public function setAdUnfeatured($ad_id){
        $ad=Ad::find($ad_id);
        $ad->update([
            'featured'=>0,
        ]);
        return $this->successResponse($ad);
    }
    public function reviews(Ad $ad){
        $ad->load('reviews');
        return $this->successResponse($ad);
    }
}
