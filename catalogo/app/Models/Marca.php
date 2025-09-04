<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    public $timestamps = false; // no usamos created_at & updated_at y esta es la forma de indicarlo
    protected $primaryKey = 'idMarca'; // clave primaria no es 'id' sino 'idMarca'
    
}
