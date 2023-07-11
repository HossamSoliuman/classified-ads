<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
class CustomRatingController extends Controller
{
    use ApiResponse;
    public function setRating(Ad $ad,$rating){
        $ad->update([
            'custom_rating'=>$rating,
        ]);
        return $this->successResponse(AdResource::make($ad));
    }
    
    public function unSetRating(Ad $ad){
        $ad->update([
            'custom_rating'=>null,
        ]);
        return $this->successResponse(AdResource::make($ad));
    }
}
