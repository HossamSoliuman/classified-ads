<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsEnquire extends Model
{
    use HasFactory;
    const PATH='files/contact us';
    protected $fillable=[
        'name', 
        'email',
        'phone', 
        'city',
        'topic',
        'company',
        'website', 
        'file',
        'message'
    ];
}
