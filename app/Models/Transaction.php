<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'date',
        'membership',
        'service',
        'amount',
        'payment_mode',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
