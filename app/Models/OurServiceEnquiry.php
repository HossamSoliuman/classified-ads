<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurServiceEnquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'city',
        'contact_number',
        'email',
        'company_name',
        'website',
        'service_id',
        'enquirement',
    ];
}
