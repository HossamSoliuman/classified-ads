<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductType;
use App\Models\PriceType;
use App\Models\UnitType;
use App\Models\OrderType;
use App\Models\ModeOfPayment;
use App\Models\Area;
use App\Models\OfferType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ad extends Model
{
    use HasFactory;
    const DRAFT = 'draft';
    const PENDING_APPROVAL = 'pending_approval';
    const APPROVED = 'approved';
    const PUBLISHED = 'published';
    const REJECTED = 'rejected';
    const SUSPENDED = 'suspended';
    const PATH = 'images/ads';
    protected $fillable = [
        'start_date',
        'status',
        'user_id',
        'badge',
        'product_title',
        'address',
        'state',
        'city',
        'contact_no',
        'opening_hours',
        'year_of_establishment',
        'gstn',
        'pan',
        'social_links',
        'category_id',
        'sub_category_id',
        'product_type_id',
        'price_type_id',
        'unit_type_id',
        'order_type_id',
        'mode_of_payment_id',
        'area_id',
        'offer_type_id',
        'return_policy',
        'features',
        'product_description',
        'company_description',
        'featured',
        
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function priceType(): BelongsTo
    {
        return $this->belongsTo(PriceType::class);
    }

    public function unitType(): BelongsTo
    {
        return $this->belongsTo(UnitType::class);
    }

    public function orderType(): BelongsTo
    {
        return $this->belongsTo(OrderType::class);
    }

    public function modeOfPayment(): BelongsTo
    {
        return $this->belongsTo(ModeOfPayment::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function offerType(): BelongsTo
    {
        return $this->belongsTo(OfferType::class);
    }
    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

}
