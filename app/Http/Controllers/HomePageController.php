<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchHomeRequest;
use App\Http\Resources\HomeSearchResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class HomePageController extends Controller
{
    use ApiResponse;

    public function search(SearchHomeRequest $request)
    {
        $city = $request->validated('city');
        $category_id = $request->validated('category_id');
        $keyWord = $request->validated('key');
        if(!$city && !$category_id && !$keyWord) {
            return $this->errorResponse('No search parameters provided', 404);
        }
        $query = Ad::query();

        if ($city) {
            $query->where('city', 'like', '%' . $city . '%');
        }

        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        if ($keyWord) {
            $query->where(function ($q) use ($keyWord) {
                $q->where('product_title', 'like', '%' . $keyWord . '%')
                    ->orWhere('product_description', 'like', '%' . $keyWord . '%');
            });
        }

        $ads = $query->get(['id', 'product_title', 'product_description']);

        $ads = HomeSearchResource::collection($ads);

        return $this->successResponse($ads);
    }
}
