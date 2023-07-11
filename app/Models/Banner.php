<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const PATH = 'images/banners';
    public $types = ['category', 'subcategory'];
    const CATEGORY_TYPE = 'category';
    const SUBCATEGORY_TYPE = 'subcategory';
    use HasFactory;
    protected $fillable = [
        'image',
        'link',
        'parent_id',
        'type',
    ];
    public function category()
    {

        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(subcategory::class, 'parent_id');
    }
}
