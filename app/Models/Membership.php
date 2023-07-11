<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable=[
        'membership_plan_id',
        'starts_at',
        'limit',
        'ends_at',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function MembershipPlan(){
        return $this->belongsTo(MembershipPlan::class);
    }
}
