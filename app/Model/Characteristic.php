<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\model\Product;

class Characteristic extends Model
{
    protected $fillable = ['product_id', 'characteristic'];

    public function products(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
