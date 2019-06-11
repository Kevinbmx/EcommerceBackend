<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'values';
    protected $fillable = [
        'value'
    ];
}
