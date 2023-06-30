<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
    public function banner()
    {
        return $this->hasOne(Banner::class, 'parent_id', 'id')
            ->where('type', Banner::CATEGORY_TYPE);
    }
}
