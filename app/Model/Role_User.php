<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    // use Notifiable;
    protected $table = 'role_user';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
        // return $this->hasMany('App\User');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public $timestamps = true;

    protected $fillable = [
        'role_id', 'user_id'
    ];

}
