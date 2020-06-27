<?php

namespace App\model;
use Illuminate\Database\Eloquent\Model;
use App\model\Permission;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];
    public function users(){
        return $this->hasMany('App\model\Users');
    }
    

    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id');
    }
}
