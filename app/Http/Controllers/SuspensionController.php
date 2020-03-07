<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DateTime;

use App\User;
use App\Usada;
use App\Gestion;
use App\Personal;
use App\Vacacion;
use App\Suspension;

class SuspensionController extends Controller
{

    public function aceptar_suspension_rr_hh(Request $request){
        $id_sol_suspension = $request->id_suspension;

        $solicitud=Suspension::find($id_sol_suspension);
        $solicitud->estado=4 ; //AUTORIZADA por RR.HH.

        if($solicitud->save())
        {
            $actualiza_supension = Usada::where('id_usuario', $solicitud->id_usuario)
            ->where('id_estado', 10)
            ->where('id_solicitud', $solicitud->id_vacacion)
            ->get();
            if (count($actualiza_supension) > 0) {
                foreach ($actualiza_supension as $update) {
                    $fecha = Usada::find($update->id);
                    $fecha->id_estado = 11; //Actualizado a Suspension autorizada
                    $fecha->color = '#00de78eb';
                    $fecha->save();
                }

                foreach ($actualiza_supension as $update_gestion) {
                    $gestion = Gestion::find($update_gestion->id_gestion);
                    $gestion->computo = $gestion->computo - $update_gestion->usadas;
                    $gestion->saldo = $gestion->saldo + $update_gestion->usadas;
                    $gestion->save();
                }
                return 'ok';
            }else{
                return 'failed' ;
            }
            return 'ok' ;
        }
        else
        {
            return 'failed' ;
        }
    }

    public function aceptar_suspension_unidad(Request $request){
        $id_sol_suspension = $request->id_suspension;

        $solicitud=Suspension::find($id_sol_suspension);
        $solicitud->estado=3 ; //Aprobada por el jefe

        if($solicitud->save())
        {
            $actualiza_supension = Usada::where('id_usuario', $solicitud->id_usuario)
            ->where('id_estado', 9) // Debe estar SOLICITADA
            ->where('id_solicitud', $solicitud->id_vacacion)
            ->get();
            if (count($actualiza_supension) > 0) {
                foreach ($actualiza_supension as $update) {
                    $fecha = Usada::find($update->id);
                    $fecha->id_estado = 10; // Actualizando a: APROBADA
                    $fecha->color = '#ffb100d1';
                    $fecha->save();
                }
                return 'ok';
            }else{
                return 'failed' ;
            }
        }
        else
        {
            return 'failed' ;
        }
    }

    public function listado_suspension_rr_hh()
    {
        $id = Auth::User()->id;
        $usuario=User::find($id);
        $persona = Personal::where('cedula', $usuario->ci)->first();
        
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('suspensiones', 'users.id', '=', 'suspensiones.id_usuario')
            ->join('vacaciones', 'suspensiones.id_vacacion', '=', 'vacaciones.id')
            ->join('estados', 'suspensiones.estado', '=', 'estados.id')
            ->join('usadas', 'suspensiones.id_vacacion', '=', 'usadas.id_solicitud')
            // ->where('personal.idarea', $persona->idarea)
            ->whereBetween('suspensiones.estado', [2, 5])
            ->whereBetween('usadas.id_estado',[9, 12])
            ->select('personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
            'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 'unidades.id as idunidad',
             'direcciones.nombre as direccion', 'suspensiones.*', 'suspensiones.id as id_suspension', 'vacaciones.id as id_solicitud',
             'estados.estado',
             \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
            //  \DB::raw('SUM(usadas.usadas) as dias')
             \DB::raw('COUNT(usadas.usadas) as dias')
             )
            ->groupBy('vacaciones.id')
            ->get();
        return view('listados.listado_suspension_rr_hh')

            ->with('usuario', $usuario)->with('personal', $personal);
    }

    public function listado_suspension_unidad()
    {
        $id = Auth::User()->id;
        $usuario=User::find($id);
        $persona = Personal::where('cedula', $usuario->ci)->first();
        
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('suspensiones', 'users.id', '=', 'suspensiones.id_usuario')
            ->join('vacaciones', 'suspensiones.id_vacacion', '=', 'vacaciones.id')
            ->join('estados', 'suspensiones.estado', '=', 'estados.id')
            ->join('usadas', 'suspensiones.id_vacacion', '=', 'usadas.id_solicitud')
            ->where('personal.idarea', $persona->idarea)
            ->whereBetween('suspensiones.estado', [2, 5])
            ->whereBetween('usadas.id_estado',[9, 12])
            ->select('personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
            'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 'unidades.id as idunidad',
             'direcciones.nombre as direccion', 'suspensiones.*', 'suspensiones.id as id_suspension', 'vacaciones.id as id_solicitud',
             'estados.estado',
             \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
            //  \DB::raw('SUM(usadas.usadas) as dias')
             \DB::raw('COUNT(usadas.usadas) as dias')
             )
            ->groupBy('vacaciones.id')
            ->get();

        return view('listados.listado_suspension_unidad')

            ->with('usuario', $usuario)->with('personal', $personal);
    }

    public function listado_suspension_usuario()
    {
        $id = Auth::User()->id;
        $usuario=User::find($id);
        $persona = Personal::where('cedula', $usuario->ci)->first();
        
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('suspensiones', 'users.id', '=', 'suspensiones.id_usuario')
            ->join('vacaciones', 'suspensiones.id_vacacion', '=', 'vacaciones.id')
            ->join('estados', 'suspensiones.estado', '=', 'estados.id')
            ->join('usadas', 'suspensiones.id_vacacion', '=', 'usadas.id_solicitud')
            // ->where('personal.idarea', $persona->idarea)
            ->whereBetween('suspensiones.estado', [2, 5])
            ->whereBetween('usadas.id_estado',[9, 12])
            ->where('suspensiones.id_usuario', '=', $id)
            ->select('personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
            'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 'unidades.id as idunidad',
             'direcciones.nombre as direccion', 'suspensiones.*', 'suspensiones.id as id_suspension', 'vacaciones.id as id_solicitud',
             'estados.estado',
             \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
            //  \DB::raw('SUM(usadas.usadas) as dias')
             \DB::raw('COUNT(usadas.usadas) as dias')
             )
            ->groupBy('vacaciones.id')
            ->get();
        // $vacaciones = Vacacion::where('id_usuario', $id)->first();
        // $gestion = Gestion::where('id_usuario', $id)->orderBy('vigencia', 'desc')->first();
        // $computo = Usada::where('id_usuario', $id)->where('id_gestion',$gestion->id)->sum('usadas');
        return view('listados.listado_suspension_usuario')
            // ->with('vacaciones', $vacaciones)
            // ->with('computo', $computo)
            // ->with('gestion', $gestion)
            ->with('usuario', $usuario)->with('personal', $personal);
    }

    public function form_sol_suspension_rr_hh($id_suspension)
    {
        $suspension = Suspension::where('id', $id_suspension)->first();
        $id_solicitud = $suspension->id_vacacion;

        $hoy = new DateTime(date('Y-m-d'));
        $vacaciones = Vacacion::where('id', $id_solicitud)->first();
        // $usuario=User::find($vacaciones->id_usuario)->first();
        // $cas=Calificacion::all();
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('vacaciones', 'users.id', '=', 'vacaciones.id_usuario')
            ->join('estados', 'vacaciones.id_estado', '=', 'estados.id')
            ->where('users.id', $vacaciones->id_usuario)
            ->where('vacaciones.id', $id_solicitud)
            ->select('personal.*', 'users.*', 'cargos.*', 'areas.*', 'unidades.nombre as unidad', 
            'direcciones.nombre as direccion', 'vacaciones.*', 'vacaciones.id as id_solicitud')
            ->get();

            $total = Usada::where('id_usuario', $vacaciones->id_usuario)
            ->where('id_solicitud', $id_solicitud)
            ->select(\DB::raw('SUM(usadas.usadas) as total'))
            ->orderBy('title', 'asc')->get();
    
            $usadas = \DB::table('usadas')
            ->select('usadas.*', \DB::raw("group_concat(start SEPARATOR ', ') as inicio"))
            ->where('id_solicitud', $id_solicitud)
            ->groupBy('title')
            ->get();

            $suspendidas = \DB::table('usadas')
            ->select('usadas.*', \DB::raw("group_concat(start SEPARATOR ', ') AS fechas_sus"))
            ->where('id_solicitud', $id_solicitud)
            ->where('id_estado', 10) //suspension aprobada
            ->groupBy('title')
            ->get();
        
            $disponibles = \DB::table('users')
            ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
            ->where('users.id', $vacaciones->id_usuario)
            ->where('gestiones.vigencia', '>', $hoy)
            ->select(\DB::raw('SUM(gestiones.saldo) as saldo'))->get();

        return view('formularios.form_sol_suspension_rr_hh')
            ->with('total', $total)
            ->with('usadas', $usadas)
            ->with('suspendidas', $suspendidas)
            ->with('disponibles', $disponibles)
            ->with('personal', $personal);

    }

    public function form_sol_suspension_unidad($id_suspension)
    {
        $suspension = Suspension::where('id', $id_suspension)->first();
        $id_solicitud = $suspension->id_vacacion;

        $hoy = new DateTime(date('Y-m-d'));
        $vacaciones = Vacacion::where('id', $id_solicitud)->first();
        // $usuario=User::find($vacaciones->id_usuario)->first();
        // $cas=Calificacion::all();
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('vacaciones', 'users.id', '=', 'vacaciones.id_usuario')
            ->join('estados', 'vacaciones.id_estado', '=', 'estados.id')
            ->where('users.id', $vacaciones->id_usuario)
            ->where('vacaciones.id', $id_solicitud)
            ->select('personal.*', 'users.*', 'cargos.*', 'areas.*', 'unidades.nombre as unidad', 
            'direcciones.nombre as direccion', 'vacaciones.*', 'vacaciones.id as id_solicitud')
            ->get();

            $total = Usada::where('id_usuario', $vacaciones->id_usuario)
            ->where('id_solicitud', $id_solicitud)
            ->select(\DB::raw('SUM(usadas.usadas) as total'))
            ->orderBy('title', 'asc')->get();
    
            $usadas = \DB::table('usadas')
            ->select('usadas.*', \DB::raw("group_concat(start SEPARATOR ', ') as inicio"))
            ->where('id_solicitud', $id_solicitud)
            ->groupBy('title')
            ->get();

            $suspendidas = \DB::table('usadas')
            ->select('usadas.*', \DB::raw("group_concat(start SEPARATOR ', ') AS fechas_sus"))
            ->where('id_solicitud', $id_solicitud)
            ->where('id_estado', 9)// Suspensión solicitada
            ->groupBy('title')
            ->get();
        
            $disponibles = \DB::table('users')
            ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
            ->where('users.id', $vacaciones->id_usuario)
            ->where('gestiones.vigencia', '>', $hoy)
            ->select(\DB::raw('SUM(gestiones.saldo) as saldo'))->get();

        return view('formularios.form_sol_suspension_unidad')
            ->with('total', $total)
            ->with('usadas', $usadas)
            ->with('suspendidas', $suspendidas)
            ->with('disponibles', $disponibles)
            ->with('personal', $personal);

    }

    public function form_sol_suspension_usuario($id_sol)
    {
        $limpia_supension = Usada::where('id_usuario', Auth::user()->id)
        ->where('id_estado', 8)
        ->where('id_solicitud', $id_sol)
        ->get();
        if (count($limpia_supension) > 0) {
            foreach ($limpia_supension as $limpia) {
                $fecha = Usada::find($limpia->id);
                $fecha->id_estado = 6;
                $fecha->save();
            }
        }

        $user_id = Auth::user()->id;
        $usuario=User::find($user_id);
        $computo=Usada::all();

        $gestiones = Gestion::select(\DB::raw('gestiones.*, SUM(usadas.usadas) as total'), 'gestiones.id as id_gestion')
        ->leftJoin('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
        // ->where('vigencia', '>', $hoy)
        ->where('gestiones.id_usuario', $user_id)
       //  ->where('gestiones.id', '=', 'usadas.id_gestion')
        ->groupBy('gestiones.id')
        ->get();

        $ultima_gestion = Gestion::where('id_usuario', $user_id)->orderBy('id', 'desc')->first();
        // $cas=Calificacion::where('id_usuario', $user_id)->orderBy('id', 'desc')->first();
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.id_cargo', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->where('cedula', $usuario->ci)
            ->select('personal.*', 'users.*', 'users.id as id_usuario', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 
            'direcciones.nombre as direccion')->get();
            // $vacaciones = Vacacion::where('id_usuario', $id)->first();
            return view('formularios.form_sol_suspension_usuario')
            // ->with('vacaciones', $vacaciones)
            // ->with('cas', $cas)
            ->with('id_sol', $id_sol)
            ->with('gestiones', $gestiones)
            ->with('ultima_gestion', $ultima_gestion)
            ->with('computo', $computo)
            ->with('personal', $personal);
    }
}
