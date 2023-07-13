<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerEnquire extends Model
{
    use HasFactory;
    const PATH='files/resumes';
    protected $fillable = [
        'name',
        'city',
        'qualification',
        'post_for_apply',
        'phone',
        'experience',
        'email',
        'skill',
        'resume'
    ];
}
