<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlendAttributeValue extends Model
{
    use HasFactory;
    protected $table = 'blend_attribute_values';
    protected $fillable = [
        'attribute_id','value_id'
    ];
}
