<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the reviews for the specified ad.
     *
     * @param int $ad_id
     * @return \Illuminate\Http\Response
     */
    public function index($ad_id)
    {
        $reviews = Review::where('ad_id', $ad_id)->get();

        return $this->successResponse(ReviewResource::collection($reviews));
    }

    /**
     * Store a newly created review in storage.
     *
     * @param \App\Http\Requests\StoreReviewRequest $request
     * @param int $ad_id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $user = Auth::user();
        $ad_id = $request->input('ad_id');

        // Check if the user has already reviewed the ad
        $existingReview = Review::where('ad_id', $ad_id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingReview) {
            return $this->errorResponse('You have already reviewed this ad.', 422);
        }

        // Create the new review
        $review = Review::create($request->validated());

        return $this->successResponse(ReviewResource::make($review), 'Review created successfully.', 201);
    }

    /**
     * Update the specified review in storage.
     *
     * @param \App\Http\Requests\UpdateReviewRequest $request
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        if (Auth::id() != $review->user_id) {
            return $this->errorResponse('You can\'t update this review', 401);
        }

        $review->update($request->validated());

        return $this->successResponse(ReviewResource::make($review), 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if (Auth::id() != $review->user_id) {
            return $this->errorResponse('You can\'t delete this review', 401);
        }

        $review->delete();

        return $this->customResponse(null, 'Review deleted successfully.');
    }
}
