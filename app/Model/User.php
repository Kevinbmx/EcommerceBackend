<?php

namespace App\model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Support\FilterPaginateOrder;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use FilterPaginateOrder;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    protected $filter = [
        'id', 'name', 'email', 'created_at'
    ];

    public static function initialize()
    {
        return [
            'name' => '', 'email' => ''
        ];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','id'
    ];


    public function products(){
        return $this->hasMany('App\model\Product');
    }
   
    public function rol(){
        return $this->hasOne('App\model\Rol');
    }
}
