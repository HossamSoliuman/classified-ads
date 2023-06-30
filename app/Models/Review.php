<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'ad_id',
        'body',
        'number_of_stars',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ad(){
        return $this->belongsTo(ad::class);
    }
}
