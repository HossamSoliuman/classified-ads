<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    const PATH='images/brands';
    protected $fillable=[
        'description',
        'image',
        'url',
    ];
}
