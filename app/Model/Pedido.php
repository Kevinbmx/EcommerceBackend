<?php

namespace App\model;

use App\model\Carrito;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';

    protected $fillable = ['estado', 'fecha_entrega','fecha_anulacion','motivo_anulacion','total','user_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function carrito(){
        return $this->hasMany(Carrito::class);
    }
}
