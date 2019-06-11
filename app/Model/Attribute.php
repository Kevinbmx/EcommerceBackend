<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    protected $table = 'attributes';
    protected $fillable = [
        'name'
    ];
}
