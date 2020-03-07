<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direccion;

class DireccionController extends Controller
{
    function consultaDirecciones($id_min){
        $direcciones = \DB::table('areas')
        ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
        ->where('areas.idmin', $id_min)
        ->select('direcciones.id as id_dir', 'direcciones.nombre as nombre_dir')->distinct('nombre_dir')
        ->get();
        return $direcciones;

    }
}
