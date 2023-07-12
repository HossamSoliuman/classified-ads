<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMessageUser extends Model
{
    protected $fillable = [
        'user_id',
        'message_id',
    ];
    
    use HasFactory;
   

}
