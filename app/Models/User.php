<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Product;
use Laravel\Passport\HasApiTokens;
use App\Support\FilterPaginateOrder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
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
        return $this->hasMany(Product::class);
    }

    public function rol(){
        return $this->hasOne(Role::class);
    }

}
