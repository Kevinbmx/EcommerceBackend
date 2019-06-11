<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // use Notifiable;
    
    public $timestamps = true;
    protected $table = 'roles';

    protected $fillable = [
        'name', 'slug', 'description'
    ];

  

}
