<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdEnquirController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomRatingController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\ModeOfPaymentController;
use App\Http\Controllers\OfferTypeController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\OurServiceEnquiryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PriceTypeController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ReturnPolicyController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceEnquiryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriptionRequestController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Models\AdEnquir;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::post('register',function(){
//     return 'ahha';
// });
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('home/search', [HomePageController::class, 'search']);
Route::get('home/featured-ads', [HomePageController::class, 'featuredAds']);

Route::get('ads/{ad}/reviews', [AdController::class, 'reviews']);
Route::get('categories/{category}/featured-ads', [CategoryController::class, 'featuredAds']);
Route::get('categories/{category}/banners', [CategoryController::class, 'banners']);

Route::get('sub-categories/{sub_category}/featured-ads', [SubCategoryController::class, 'featuredAds']);
Route::get('sub-categories/{sub_category}/banners', [SubCategoryController::class, 'banners']);

Route::get('categories/{category}/posts', [CategoryController::class, 'posts']);
Route::get('posts/{post}/comments', [PostController::class, 'comments']);
Route::apiResource('service-enquiries', ServiceEnquiryController::class)->only(['store']);
Route::apiResource('our-service-enquiries', OurServiceEnquiryController::class)->only(['store']);
Route::apiResource('membership-plans', MembershipPlanController::class)->only(['index', 'show']);
////////////////////////////////////////////////////////////////////////////////////////////////////////
// auth routes


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user-dashboard')->group(function () {
        Route::get('cards-data', [UserDashboardController::class, 'cardsData']);
        Route::get('reviews', [UserDashboardController::class, 'reviews']);
        Route::get('my-ads', [UserDashboardController::class, 'myAds']);
        Route::get('enquires', [UserDashboardController::class, 'enquires']);
        Route::get('transactions',[UserDashboardController::class,'transactions']);
    });
    Route::apiResource('subscription-request', SubscriptionRequestController::class)->only('store');
    Route::get('users/auth/usage', [UserController::class, 'authUsage']);
    Route::get('users/auth/memberships', [UserController::class, 'authMemberships']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::apiResource('users', UserController::class)->only(['show']);
    Route::post('users', [UserController::class, 'update']);
    Route::get('auth', [UserController::class, 'auth']);
    Route::apiResource('ad-enquires',AdEnquirController::class)->only(['store','show','delete']);

    Route::apiResources(
        [
            'reviews' => ReviewController::class,
            'comments' => CommentController::class,
            'ads' => AdController::class,
        ],
        ['except' => ['index']]
    );
    Route::apiResources(
        [
            'areas' => AreaController::class,
            'categories' => CategoryController::class,
            'mode-of-payments' => ModeOfPaymentController::class,
            'offer-types' => OfferTypeController::class,
            'order-types' => OrderTypeController::class,
            'price-types' => PriceTypeController::class,
            'product-types' => ProductTypeController::class,
            'return-policies' => ReturnPolicyController::class,
            'sub-categories' => SubCategoryController::class,
            'unit-types' => UnitTypeController::class,
        ],
        ['only' => 'index']
    );
    Route::apiResources(
        [
            'brands' => BrandController::class,
            'boxes' => BoxController::class,
            'sliders' => SliderController::class,
            'services' => ServiceController::class,
            'testimonials' => TestimonialController::class,
        ],
        [
            'only' => ['index', 'show']
        ]
    );

    Route::apiResource('posts', PostController::class)->only(['show']);
});
/////////////////////////////////////////////////////////////////////////////////
//admin routes

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('users', UserController::class)->only(['destroy', 'index']);
    Route::delete('product-images', [ProductImageController::class, 'destroy']);
    Route::get('ads/featured/{ad_id}', [AdController::class, 'setAdFeatured']);
    Route::get('users/{user}/usage', [UserController::class, 'usage']); //user usage
    Route::get('users/{user}/memberships', [UserController::class, 'memberships']); //user usage
    Route::get('ads/unfeatured/{ad_id}', [AdController::class, 'setAdUnfeatured']);
    Route::get('ads/{ad}/set-rating/{rating}',[CustomRatingController::class,'setRating']);
    Route::get('ads/{ad}/unset-rating',[CustomRatingController::class,'unSetRating']);
    Route::apiResources([
        'areas' => AreaController::class,
        'categories' => CategoryController::class,
        'mode-of-payments' => ModeOfPaymentController::class,
        'offer-types' => OfferTypeController::class,
        'order-types' => OrderTypeController::class,
        'price-types' => PriceTypeController::class,
        'product-types' => ProductTypeController::class,
        'return-policies' => ReturnPolicyController::class,
        'sub-categories' => SubCategoryController::class,
        'unit-types' => UnitTypeController::class,
        'sliders' => SliderController::class,
        'brands' => BrandController::class,
        'boxes' => BoxController::class,
        'service-enquiries' => ServiceEnquiryController::class,
        'posts' => PostController::class,
        'comments' => CommentController::class,
        'services' => ServiceController::class,
        'testimonials' => TestimonialController::class,
        'our-service-enquiries' => OurServiceEnquiryController::class,
        'membership-plans' => MembershipPlanController::class,
        'memberships' => MembershipController::class,
        'subscription-request' => SubscriptionRequestController::class,
        'transactions'=>TransactionController::class,
        'ad-enquires'=>AdEnquirController::class,
        'banners'=> BannerController::class,
    ]);
});
