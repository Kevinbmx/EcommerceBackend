<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrusel extends Model
{
    use HasFactory;
    protected $table = 'carrusel';
    protected $fillable = [
        'descripcion', 'url', 'pathFile', 'enable','pathName','pathFileMobile','pathNameMobile'
    ];
}
