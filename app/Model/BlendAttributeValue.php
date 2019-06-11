<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class BlendAttributeValue extends Model
{
    protected $table = 'blend_attribute_values';
    protected $fillable = [
        'attribute_id','value_id'
    ];
}
