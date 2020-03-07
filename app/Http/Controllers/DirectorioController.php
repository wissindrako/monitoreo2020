<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Directorio;

class DirectorioController extends Controller
{
    //
    public function listado_personas(){

        return view('listados.listado_personas');
    }

}
