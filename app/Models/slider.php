<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
    const PATH='images/sliders';
    protected $fillable=[
        'image',
        'url',
        'position',
        'description'
    ];
}
