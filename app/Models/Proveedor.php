<?php

namespace App\Models;

use App\Models\phone;
use App\Models\Product;
use App\Models\Direccion_proveedor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre', 'descripcion','nit'
    ];
    protected $table = 'proveedor';

    protected $filter = [
        'id', 'nombre', 'descripcion', 'nit','statusProduct_id','created_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function phones()
    {
        return $this->hasMany(phone::class);
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion_proveedor::class);
    }
}
