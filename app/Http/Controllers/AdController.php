<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\AdResource;
use App\Models\ProductImage;
use App\Models\Usage;
use App\Services\UpdateAdStatusService;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;
use Illuminate\Http\Request;

class AdController extends Controller
{
    use ApiResponse, ManagesFiles;
    private $relations=[
        'category',
        'subCategory',
        'productType',
        'priceType',
        'unitType',
        'orderType',
        'modeOfPayment',
        'area',
        'offerType',
        'productImages',
        'reviews',
        'returnPolicy',
    ];

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ads = Ad::with($this->relations)->paginate($request->query('per_page', 15));
        return $this->successResponse(AdResource::collection($ads));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        return $request->all();
        $data = $request->validated();
        $data['status'] = Ad::DRAFT;
        $data['user_id'] = auth()->id();
        $ad = Ad::create($data);
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
        $data = $request->validated();
        $data['status'] = Ad::DRAFT;
        $ad->update($data);
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
        if ($ad->status == Ad::APPROVED) {
            $usage = Usage::where('user_id', $ad->user_id)->get();
            $usage->update([
                'used' => $usage->used - 1,
            ]);
        }
        $ad->delete();
        return $this->customResponse([], 'succussfully deleted');
    }
    public function setAdFeatured($ad_id,$value)
    {
        //value reffers to showing ad in home or category or subcategory (3,2,1) 
        $ad = Ad::find($ad_id);
        $ad->update([
            'featured' => $value,
        ]);
        return $this->successResponse($ad);
    }
    public function setAdUnfeatured($ad_id)
    {
        $ad = Ad::find($ad_id);
        $ad->update([
            'featured' => 0,
        ]);
        return $this->successResponse($ad);
    }
    public function reviews(Ad $ad)
    {
        $ad->load('reviews');
        return $this->successResponse($ad);
    }
    public function updateStatus(Ad $ad, $status)
    {
        $updateService = new UpdateAdStatusService();
        return $updateService->updateStatus($ad, $status);
    }

    public function updateStatusold(Ad $ad, $status)
    {
        $isOwner = auth()->id() == $ad->user_id;
        $isAdmin = auth()->user()->role == 'admin';
        $lastStatus = $ad->status;
        $userUsage = Usage::where('user_id', $ad->user_id)->first();

        if (!$isAdmin || !$isOwner) {
            return $this->errorResponse('unauthorized action', 401);
        }
        if ($status == Ad::DRAFT) {
            if ($isOwner && $lastStatus == Ad::PENDING_APPROVAL) {
                $ad->status = $status;
                return $this->successResponse($ad);
            } else
                return  $this->errorResponse('Ad status cant be updated', 400);
        }
        if ($status == Ad::APPROVED) {
            if ($isAdmin && $lastStatus == Ad::PENDING_APPROVAL) {
                $ad->status = $status;
                return $this->successResponse($ad);
            } else
                return  $this->errorResponse('Ad status cant be updated', 400);
        }
        if ($status == Ad::PUBLISHED) {
            if ($isOwner && in_array($lastStatus, [Ad::PENDING_APPROVAL, Ad::SUSPENDED])) {
                if ($userUsage->used < $userUsage->max_limit) {
                    $userUsage->increment('used', 1);
                    $ad->status = $status;
                } else {
                    return $this->errorResponse('you reached the max limit upgrage your membership to can post more', 400);
                }
                return $this->successResponse($ad);
            } else
                return  $this->errorResponse('Ad status cant be updated', 400);
        }
        if ($status == Ad::REJECTED) {
            if ($isAdmin && in_array($lastStatus, [Ad::PENDING_APPROVAL])) {
                $ad->status = $status;
                return $this->successResponse($ad);
            } else
                return  $this->errorResponse('Ad status cant be updated', 400);
        }
        if ($status == Ad::SUSPENDED) {
            if ($isOwner && in_array($lastStatus, [Ad::PUBLISHED])) {
                $userUsage->decrement('used', 1);
                $ad->status = $status;
                return $this->successResponse($ad);
            } else
                return  $this->errorResponse('Ad status cant be updated', 400);
        }
    }
}
