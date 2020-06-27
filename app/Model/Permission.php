<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\model\Rol;
use App\model\Module;
class Permission extends Model
{
    protected $fillable = [
        'name', 'module_id'
    ];

    public function roles(){
        return $this->belongsToMany(Rol::class,'role_permission','role_id','permission_id');
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }
}
