<?php

namespace App\Models;

use App\Models\Value;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table = 'attribute_values';

    protected $fillable = [
        'attribute_id','value_id'
    ];

    public function attribute()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function value()
    {
        return $this->belongsToMany(Value::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
