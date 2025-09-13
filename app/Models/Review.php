<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = ['restaurant_id','comment','rate'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
