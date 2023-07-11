<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdEnquir extends Model
{
    protected $fillable=[
        'ad_id',
        'body',
        'ad_owner_id',
        'sender_id'
    ];
    use HasFactory;
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function ad(){
        return $this->belongsTo(ad::class);       
    }
    public function adOwner(){
        return $this->belongsTo(User::class,'ad_owner_id');
    }
}
