<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const PATH='images/users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'designation',
        'phone',
        'email',
        'password',
        'image',
        'birthday',

        'company_name', 
        'website',
        'pan_number',  
        'gst_number',
        'social_links',

        'house_no',
        'street',      
        'landmark',
        'post_code', 
        'city',
        'state',  
        'country' 
    ];
  


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function ads(){
        return $this->hasMany(Ad::class);
    }
    public function recievedAdsEnquires(){
        return $this->hasMany(AdEnquir::class,'ad_owner_id');
    }
    public function sentAdsEnquires(){
        return $this->hasMany(AdEnquir::class,'sender_id');
    }
    public function usage(){
        return $this->hasOne('usage');
    }
    public function memberships(){
        return $this->hasMany(Membership::class);
    }
    
    public function adminMessages()
    {
        return $this->belongsToMany(AdminMessage::class);
    }
}
