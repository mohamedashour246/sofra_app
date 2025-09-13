<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{
    use HasFactory , HasApiTokens;

    protected $table = 'restaurants';

    protected $fillable = ['name','email','password','phone','district_id','cat_id','minimum_order','delivery_fees','phone_contact','phone_whatsapp','image','is_available','api_token','pin_code'];

    public function district()
    {
        return $this->belongsTo('App\Models\District','district_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','category_restaurants');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer','restaurant_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order','restaurant_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment','restaurant_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function deviceTokens()
    {
        return $this->hasMany('App\Models\Token','restaurant_id');
    }
}
