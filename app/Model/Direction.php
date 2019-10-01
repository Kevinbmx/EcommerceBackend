<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $table = 'directions';

    protected $fillable = ['name', 'direction','latitud','longitud','phone_number','user_id'];

    protected $hidden = ['user_id','created_at', 'updated_at'];
}
