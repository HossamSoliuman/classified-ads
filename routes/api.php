<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ModeOfPaymentController;
use App\Http\Controllers\OfferTypeController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\PriceTypeController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ReturnPolicyController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceEnquiryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\UserController;
use App\Models\ServiceEnquiry;
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
Route::apiResource('sliders', SliderController::class)->only(['index', 'show']);
Route::get('ads/{ad}/reviews',[AdController::class,'reviews']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::apiResource('users', UserController::class)->only(['show']);
    Route::post('users', [UserController::class, 'update']);
    Route::get('auth', [UserController::class, 'auth']);
    Route::apiResources([
        'reviews' => ReviewController::class,
        'ads' => AdController::class,
    ]);
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
        ],
        [
            'only' => ['index', 'show']
        ]
    );
    Route::apiResource('service-enquiries',ServiceEnquiryController::class)->only(['store']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('users', UserController::class)->only(['destroy', 'index']);
    Route::delete('product-images', [ProductImageController::class, 'destroy']);
    Route::get('ads/featured/{ad_id}', [AdController::class, 'setAdFeatured']);
    Route::get('ads/unfeatured/{ad_id}', [AdController::class, 'setAdUnfeatured']);
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
        'service-enquiries'=>ServiceEnquiryController::class,
    ]);
});
