<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VistasController extends Controller
{
    public function form_vista_recintos(){
        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();


        return view('formularios.form_vista_recintos')
        ->with('circunscripciones', $circunscripciones);
    }
}
