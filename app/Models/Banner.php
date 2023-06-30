<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const PATH='images/banners';
    public $types=['category','subcategory'];
    const CATEGORY_TYPE='category';
    const SUBCATEGORY_TYPE='category';
    use HasFactory;
    protected $fillable=[
        'image',
        'link',
        'parent_id',
        'type',
    ];
    public function parent()
    {
        if ($this->type === Banner::CATEGORY_TYPE) {
            return $this->belongsTo(Category::class, 'parent_id');
        } else if ($this->type === Banner::SUBCATEGORY_TYPE) {
            return $this->belongsTo(Subcategory::class, 'parent_id');
        } 
    }
}

