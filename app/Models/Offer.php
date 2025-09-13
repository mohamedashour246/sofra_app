<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = ['name','image','description','restaurant_id','available_from','available_to'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
