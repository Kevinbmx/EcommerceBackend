<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class producto_proveedor extends Model
{
    use HasFactory;

    protected $filter = [
        'id', 'proveedor_id ', 'product_id', 'price', 'estado','created_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class)->withTimestamps();
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

}
