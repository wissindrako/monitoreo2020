<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DateTime;
use App\Feriado;

class FeriadoController extends Controller
{
    public function form_feriado(){
        return view("formularios.form_feriado");
    }

    public function form_calendario_feriado(){
        return view('formularios.form_calendario_feriado');
    }

    public function calendario_feriados(){

        $events = \DB::table('feriados')
        ->select('feriados.*')
        ->get();

        $eventos = array();
        
        foreach ($events as $evento) {
            $e = array();
            $e['id'] = $evento->id;
            $e['title'] = $evento->desc_feriado;
            $e['start'] = $evento->fecha_feriado;
            $e['end'] = $evento->fecha_feriado;
            $e['color'] = $evento->color;
            $e['editable'] = false;
            
            // Merge the event array into the return array
            array_push($eventos, $e);
        }
        $eventos = json_encode($eventos);
        return  $eventos;
        // return view("formularios.form_sol_vacacion_usuario")->with('eventos', $eventos)->with('personal', $personal);
    }

    public function agregar_feriado(Request $request){
        $hoy = new DateTime(date('Y-m-d'));
        $f = new DateTime($request->input('start'));
        if ($f >= $hoy) {
    
            if($request->input('desc_feriado') != ""){
                $fecha = new Feriado;
                $fecha->fecha_feriado = $request->input('start');
                $fecha->desc_feriado = $request->input('desc_feriado');
                $fecha->color = '#C6FF00';
       
                if ($fecha->save()) {
                     return 'ok';
                   }
                   else
                   {
                     return view("mensajes.msj_solicitud_error")->with("msj","...Hubo un error al agregar la fecha...") ;
                   }
            }
            else{
                return view("mensajes.msj_solicitud_error_feriado")->with("msj","Ingrese una descripción al Feriado!") ;
            }
        }else{
            // return 'pasado';
            return view("mensajes.msj_solicitud_error_feriado")->with("msj","La fecha es anterior a la actual!") ;
        }
    }

    public function editar_feriado(Request $request){
        if($request->has('delete') && $request->has('id')){
            $fecha = Feriado::find($request->id);
            if($fecha->delete()){
                return 'ok';
            }
            else{
                return 'failed';
            }
        }
        elseif($request->has('desc_feriado') && $request->has('id')){
            $fecha = Feriado::find($request->id);
            $fecha->desc_feriado = $request->desc_feriado;
            if($fecha->save()){
                return 'ok';
            }
            else{
                return 'failed';
            }
        }
        else{
            return view("mensajes.msj_solicitud_error_feriado")->with("msj","Ingrese una descripción al Feriado!") ;
        }
    }

}
