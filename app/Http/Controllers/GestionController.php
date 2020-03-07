<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use DateTime;

use App\User;
use App\Gestion;

class GestionController extends Controller
{
    public function form_editar_gestion($id_usuario){
        $user_id = $id_usuario;
        $usuario=User::find($user_id);
        // $ultima_gestion = Gestion::where('id_usuario', $user_id)->orderBy('id', 'desc')->first();
        $hoy = new DateTime(date('Y-m-d'));
        $ultima_gestion = Gestion::where('id_usuario', $user_id)
        ->whereDate('desde', '<', $hoy)
        ->whereDate('hasta', '>', $hoy)
        ->orderBy('id', 'desc')
        ->first();
        $personal = \DB::table('personal')
        ->join('users', 'personal.cedula', '=', 'users.ci')
        ->where('cedula', $usuario->ci)
        ->select('users.*', 'users.id as id_usuario', 'personal.*')->get();

        return view('formularios.form_editar_gestion')
        ->with('ultima_gestion', $ultima_gestion)
        ->with('personal', $personal);
    }

    public function editar_gestion(Request $request){

        if ($request->has('id_gestion')) {
            $gestion = Gestion::find($request->id_gestion);
            $a = $request->input("a");
            $m = $request->input("m");
            $d = $request->input("d");
            $gestion->desde=$request->input("desde");
            $gestion->hasta=$request->input("hasta");
            $gestion->vigencia=$request->input("vigencia");
            $gestion->year=$a;
            $gestion->month=$m;
            $gestion->day=$d;

            $escala_anterior = $gestion->computo + $gestion->saldo;
            $nueva_escala = escala($a, $m, $d);
            //Actualización del campo computo
            $gestion->saldo = ($nueva_escala - $escala_anterior) + $gestion->saldo;

        }else{
            $gestion=new Gestion;

            $a = $request->input("a");
            $m = $request->input("m");
            $d = $request->input("d");
            $gestion->id_usuario=$request->input("id_usuario");
            $gestion->desde=$request->input("desde");
            $gestion->hasta=$request->input("hasta");
            $gestion->vigencia=$request->input("vigencia");
            $gestion->year=$a;
            $gestion->month=$m;
            $gestion->day=$d;
            $gestion->computo=0;
            $gestion->saldo=escala($a, $m, $d);
        }
        if($gestion->save())
        {
            return view("mensajes.msj_gestion_editada")->with("msj","Gestión actualizada correctamente") ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function form_nueva_gestion(){
        $user_id = Auth::user()->id;
        $usuario=User::find($user_id);
        $ultima_gestion = Gestion::where('id_usuario', $user_id)->orderBy('id', 'desc')->first();

        $personal = \DB::table('personal')
        ->join('users', 'personal.cedula', '=', 'users.ci')
        ->where('cedula', $usuario->ci)
        ->select('personal.*')->get();

        return view('formularios.form_nueva_gestion')
        ->with('ultima_gestion', $ultima_gestion)
        ->with('personal', $personal);
    }

    public function crear_gestion(Request $request){
        $gestion=new Gestion;
        
        $a = $request->input("a");
        $m = $request->input("m");
        $d = $request->input("d");
        $gestion->id_usuario=Auth::user()->id;
        $gestion->desde=$request->input("desde");
        $gestion->hasta=$request->input("hasta");
        $gestion->vigencia=$request->input("vigencia");
        $gestion->year=$a;
        $gestion->month=$m;
        $gestion->day=$d;
        $gestion->computo=0;
        $gestion->saldo=escala($a, $m, $d);
        
        if($gestion->save())
        {
            return view("mensajes.msj_gestion_creada")->with("msj","Gestión agregada correctamente") ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }
}
