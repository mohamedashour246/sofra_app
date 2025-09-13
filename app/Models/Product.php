<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name','image','description','price','price_offer','order_time'];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order','order_products');
    }
}
