<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    const PATH='images/categories';
    protected $fillable=[
        'name',
        'placement',
        'image',
    ];
    public function ads(){
        return $this->hasMany(Ad::class);
    }
    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }
    public function banner(){
        return $this->hasone(Banner::class,'parent_id')->where('type',Banner::SUBCATEGORY_TYPE);
    }
}
