<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    const PATH='images/posts';
    protected $fillable=[
        'title',
        'body',
        'image',
        'category_id',
    ];
}
