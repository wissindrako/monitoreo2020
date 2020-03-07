<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UnidadesController extends Controller
{
    function consultaUnidades($id_dir){
        $unidades = \DB::table('areas')
        ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
        ->where('areas.iddireccion', $id_dir)
        ->select('unidades.id as id_unidad', 'unidades.nombre as nombre_unidad')->distinct('nombre_unidad')
        ->get();
        return $unidades;
    }
}
