<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['number','address','client_id','restaurant_id','note','price','price_delivery','total','remainder','commission','order_state','payment_type'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product','order_products')->withPivot('price','quantity','note');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}
