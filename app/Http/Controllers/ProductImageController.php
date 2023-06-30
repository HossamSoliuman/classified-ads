<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;
class ProductImageController extends Controller
{
    use ApiResponse,ManagesFiles;
    public function destroy(ProductImage $productImage)
    {
        $this->deleteFile($productImage->path);
        $productImage->delete();
        return $this->customResponse([],'image deleted succussfully');
    }
}
