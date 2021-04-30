<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'module_id'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'role_permission','role_id','permission_id');
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }
}
