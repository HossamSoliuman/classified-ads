<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceEnquiry extends Model
{
    use HasFactory;
    const SELLER='seller';
    const BUYER='buyer';
    protected $fillable=[
        'name',
        'email',
        'city',
        'requirement',
        'contact_number',
        'type_of_sender',
    ];
}
