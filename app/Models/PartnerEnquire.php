<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerEnquire extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city',
        'company',
        'phone',
        'address',
        'partnership'
    ];
}
