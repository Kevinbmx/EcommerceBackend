<?php

namespace App\model;
use App\model\Permission;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name'
    ];

    public function permission(){
        return $this->hasMany(Permission::class);
    }
}
