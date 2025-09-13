<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory , HasApiTokens;

    protected $table = 'clients';

    protected $fillable = ['name','email','password','phone','district_id','api_token','pin_code'];

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function deviceTokens()
    {
        return $this->hasMany('App\Models\Token','client_id');
    }

}
