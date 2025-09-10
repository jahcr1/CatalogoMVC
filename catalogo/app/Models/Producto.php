<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    static function checkProductoXMarca( int $idMarca )
    {
        // obj || null
        // Si lo hacemos por Eloquent devuelve un objeto o null y vemos sus datos con dd
        //$check = Producto::where('idMarca', $idMarca)->first();

        // Tambien podemos usar count() que nos devuelve un int o sea 0 o 1 al checkear si existe algun producto con esa marca
        $check = Producto::where('idMarca', $idMarca)->count();
        return $check;
    }
}
