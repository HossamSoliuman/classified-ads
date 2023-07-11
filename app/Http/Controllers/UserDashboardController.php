<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdEnquir;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Psy\CodeCleaner\FunctionContextPass;

// user -> ads -> reviews 
class UserDashboardController extends Controller
{
    use ApiResponse;


    public function cardsData()
    {
        $data = [];
        $user = User::withCount(['ads' => function ($q) {
            $q->where('status', Ad::PUBLISHED);
        }])->find(auth()->id());
        $data['listing_ads'] = $user->ads_count;

        $user = User::withCount('recievedAdsEnquires')->find(auth()->id());
        $data['enquires'] = $user->recieved_ads_enquires_count;

        $totalReviews = Ad::join('reviews', 'ads.id', '=', 'reviews.ad_id')
            ->where('ads.user_id', auth()->id())
            ->count();
        $data['reviews'] = $totalReviews;
        return $this->successResponse($data);
    }

    public function reviews()
    {
        $reviews = Review::whereHas('ad.user', function ($q) {
            $q->where('id', auth()->id());
        })->orderBy('id', 'desc')->paginate(3);
        return $this->successResponse($reviews);
    }

    public function myAds()
    {
        $ads = Ad::where('user_id', auth()->id())
            ->get()
            ->groupBy(function ($ad) {
                return $ad->status;
            });
        return $this->successResponse($ads);
    }
    public function enquires(){
        $enquires=AdEnquir::where('ad_owner_id',auth()->id())->orderBy('id','desc')->paginate(10);
        return $this->successResponse($enquires);
    }
    public function transactions(){
        $transactions=Transaction::where('user_id',auth()->id())->orderBy('id','desc')->paginate(10);
        return $this->successResponse($transactions);
    }
}
