<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attribute_values';

    protected $fillable = [
        'attribute_id','value_id'
    ];
    
    public function attribute()
    {
        return $this->belongsToMany('App\Model\Attribute');
    }

    public function value()
    {
        return $this->belongsToMany('App\Model\Value');
    }

    public function product()
    {
        return $this->belongsToMany('App\Model\Product');
    }


}
