<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultasController extends Controller
{
    public function form_consulta(){
        return view('formularios.form_consulta');
    }
    public function consultaMesaAsignada($cedula){
        // if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
        //     return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        // }
        $personas = \DB::table('personas')
        ->leftjoin('users', 'personas.id_persona', 'users.id_persona')
        ->leftjoin('recintos', 'personas.id_recinto', 'recintos.id_recinto')

        ->leftjoin('rel_usuario_mesa', 'users.id', 'rel_usuario_mesa.id_usuario')
        ->leftjoin('mesas', 'rel_usuario_mesa.id_mesa', 'mesas.id_mesa')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->join('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->join('roles', 'personas.id_rol', 'roles.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
                 'recintos.zona', 'recintos.direccion as direccion_recinto', 'recintos.geolocalizacion',
                 'origen.origen', 'sub_origen.nombre as sub_origen',
                 'roles.name as nombre_rol', 'roles.description', 'roles.slug',
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
                 \DB::raw('CONCAT(personas.telefono_celular," - ", personas.telefono_referencia) as contacto'),
                 \DB::raw('CONCAT(personas.cedula_identidad, personas.complemento_cedula) as ci'),
                 \DB::raw('CONCAT("C: ", recintos.circunscripcion," - D: ", recintos.distrito," - R: ", recintos.nombre) as recinto'),
                 \DB::raw("group_concat(rel_usuario_mesa.id_mesa SEPARATOR ', ') as mesas"),
                 \DB::raw("group_concat(mesas.codigo_mesas_oep SEPARATOR ', ') as mesas_oep")
        )
        ->where('cedula_identidad', $cedula)
        ->groupBy('rel_usuario_mesa.id_usuario')
        ->orderBy('fecha_registro', 'desc')
        ->orderBy('id_persona', 'desc')
        ->get();

        return $personas;
    }
}
