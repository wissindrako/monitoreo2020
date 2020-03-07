<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class AsistenciasController extends Controller
{
  public function form_agregar_lista_de_asistencia(){
    return view("formularios.form_agregar_lista_de_asistencia");
  }

  public function agregar_lista_de_asistencia(Request $request){
    //Tomamos el id de todos los usuarios activos
    $usuarios = \DB::table('users')
    ->select('id')
    ->where('activo', 1)
    ->get();

    //Realizamos un registro para cada usuario activo, con el dia establecido
    foreach ($usuarios as $usuario) {
      \DB::table('asistencia')->insert([
          ['id_usuario' => $usuario->id,
           'detalle' => $request->detalle,
           'fecha' => $request->fecha,
           'asistencia' => 0]
      ]);
    }
    return view("mensajes.mensaje_exito")->with("msj"," Lista de asistencia registrada correctamente para fecha $request->fecha ");
  }

  public function form_listas_de_asistencia(){
    //Tomamos todas las listas creadas
    $listas = \DB::table('asistencia')
    ->select('fecha', 'detalle')
    ->distinct()
    ->get();

    return view("formularios.form_listas_de_asistencia")
          ->with("listas",$listas);
  }

  public function lista_de_asistencia_recinto(Request $request){

    //Obtenemos el usuario actual
    $id_persona = Auth::user()->id_persona;
    $usuario_recinto = \DB::table('users')
                  ->join('personas', 'personas.id_persona', '=', 'users.id_persona')
                  ->join('recintos', 'personas.id_recinto', '=', 'recintos.id_recinto')
                  ->select('recintos.id_recinto')
                  ->where('personas.id_persona', $id_persona)
                  ->first();

    //Tomamos todas las listas creadas
    $listas = \DB::table('asistencia')
    ->join('users', 'users.id', '=', 'asistencia.id_usuario')
    ->leftjoin('personas', 'personas.id_persona', '=', 'users.id_persona')
    ->leftjoin('recintos', 'personas.id_recinto', '=', 'recintos.id_recinto')
    ->leftjoin('origen', 'origen.id_origen', '=', 'personas.id_origen')
    ->leftjoin('sub_origen', 'sub_origen.id_sub_origen', '=', 'personas.id_sub_origen')
    ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
    ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')
    ->select('recintos.circunscripcion', 'recintos.distrito', 'recintos.zona', 'recintos.nombre as recinto', 'recintos.direccion as direccion_recinto', 'recintos.id_recinto',
     'asistencia.asistencia', 'asistencia.detalle',
             'users.name', 'users.email', 'users.password', 'personas.nombre as nombre_usuario', 'personas.paterno', 'personas.materno', 'personas.cedula_identidad',
             'personas.complemento_cedula', 'personas.expedido', 'personas.telefono_celular', 'personas.telefono_referencia', 'personas.direccion as direccion_usuario',
             'origen.origen', 'sub_origen.nombre as nombre_sub_origen', 'roles.description as rol')
    ->where('asistencia.fecha', $request->fecha)
    ->where('recintos.id_recinto', $usuario_recinto->id_recinto)
    ->whereBetween('role_user.role_id', [20, 21]) //Roles [responsable_mesa, ResponsableRecinto]
    ->orderBy('recintos.circunscripcion', 'ASC')
    ->orderBy('recintos.distrito', 'ASC')
    ->orderBy('recintos.zona', 'ASC')
    ->orderBy('recintos.nombre', 'ASC')
    ->orderBy('asistencia.asistencia', 'DESC')
    ->orderBy('users.email', 'ASC')
    ->get();
    // dd($listas);
    return view("listados.lista_de_asistencia_recinto")
          ->with("listas",$listas)
          ->with("fecha",$request->fecha);
  }

  public function lista_de_asistencia(Request $request){
    //Tomamos todas las listas creadas
    $listas = \DB::table('asistencia')
    ->join('users', 'users.id', '=', 'asistencia.id_usuario')
    ->leftjoin('personas', 'personas.id_persona', '=', 'users.id_persona')
    ->leftjoin('recintos', 'personas.id_recinto', '=', 'recintos.id_recinto')
    ->leftjoin('origen', 'origen.id_origen', '=', 'personas.id_origen')
    ->leftjoin('sub_origen', 'sub_origen.id_sub_origen', '=', 'personas.id_sub_origen')
    ->leftjoin('roles', 'personas.id_rol', '=', 'roles.id')
    ->select('recintos.circunscripcion', 'recintos.distrito', 'recintos.zona', 'recintos.nombre as recinto', 'recintos.direccion as direccion_recinto',
     'asistencia.asistencia', 'asistencia.detalle',
             'users.name', 'users.email', 'users.password', 'personas.nombre as nombre_usuario', 'personas.paterno', 'personas.materno', 'personas.cedula_identidad',
             'personas.complemento_cedula', 'personas.expedido', 'personas.telefono_celular', 'personas.telefono_referencia', 'personas.direccion as direccion_usuario',
             'origen.origen', 'sub_origen.nombre as nombre_sub_origen', 'roles.description as rol')
    ->where('asistencia.fecha', $request->fecha)
    ->orderBy('recintos.circunscripcion', 'ASC')
    ->orderBy('recintos.distrito', 'ASC')
    ->orderBy('recintos.zona', 'ASC')
    ->orderBy('recintos.nombre', 'ASC')
    ->orderBy('asistencia.asistencia', 'DESC')
    ->orderBy('users.email', 'ASC')
    ->get();

    return view("listados.lista_de_asistencia")
          ->with("listas",$listas)
          ->with("fecha",$request->fecha);
  }

  public function lista_de_asistencia_buscar(Request $request){
    $dato = $request->dato_buscado;
    //Tomamos todas las listas creadas
    $listas = \DB::table('asistencia')
    ->join('users', 'users.id', '=', 'asistencia.id_usuario')
    ->leftjoin('personas', 'personas.id_persona', '=', 'users.id_persona')
    ->leftjoin('recintos', 'personas.id_recinto', '=', 'recintos.id_recinto')
    ->leftjoin('origen', 'origen.id_origen', '=', 'personas.id_origen')
    ->leftjoin('sub_origen', 'sub_origen.id_sub_origen', '=', 'personas.id_sub_origen')
    ->leftjoin('roles', 'personas.id_rol', '=', 'roles.id')
    ->select('recintos.circunscripcion', 'recintos.distrito', 'recintos.zona', 'recintos.nombre as recinto', 'recintos.direccion as direccion_recinto', 
    'asistencia.asistencia', 'asistencia.detalle',
             'users.name','users.email', 'users.password', 'personas.nombre as nombre_usuario', 'personas.paterno', 'personas.materno', 'personas.cedula_identidad',
             'personas.complemento_cedula', 'personas.expedido', 'personas.telefono_celular', 'personas.telefono_referencia', 'personas.direccion as direccion_usuario',
             'origen.origen', 'sub_origen.nombre as nombre_sub_origen', 'roles.description as rol')
    ->where('recintos.circunscripcion',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('recintos.distrito',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('recintos.zona',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('recintos.nombre',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('recintos.direccion',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('users.name',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('users.email',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('personas.nombre',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('personas.paterno',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('personas.materno',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('personas.cedula_identidad',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('personas.telefono_celular',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('personas.telefono_referencia',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('personas.direccion',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('origen.origen',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('sub_origen.nombre',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orwhere('roles.description',  "like","%".$dato."%")
    ->where('asistencia.fecha', $request->fecha)
    ->orderBy('recintos.circunscripcion', 'ASC')
    ->orderBy('recintos.distrito', 'ASC')
    ->orderBy('recintos.zona', 'ASC')
    ->orderBy('recintos.nombre', 'ASC')
    ->orderBy('asistencia.asistencia', 'DESC')
    ->orderBy('users.email', 'ASC')
    ->get();

    return view("listados.lista_de_asistencia")
          ->with("listas",$listas)
          ->with("fecha",$request->fecha);
  }

  public function form_registrar_asistencia(){
    return view("formularios.form_registrar_asistencia");
  }

  public function registrar_asistencia(Request $request){
    //Tomamos el id del usuario
    $id_usuario = Auth::user()->id;

    //Tomamos la fecha actual
    $date = new Carbon();
    $hoy = Carbon::now();
    $fecha = $hoy->format('Y-m-d');

    //Verificamos que exista una lista de asistencia para el usuario y fecha actual
    $registro_fecha = \DB::table('asistencia')
                              ->where('fecha', $fecha)
                              ->distinct()
                              ->value('fecha');

    if ($registro_fecha != "") {
      //Tomamos el id del usuario que intenta registrar su asistencia
      $registro_usuario_asistencia = \DB::table('asistencia')
                                ->where('id_usuario', $id_usuario)
                                ->where('fecha', $fecha)
                                ->distinct()
                                ->value('asistencia');

      if ($registro_usuario_asistencia == "0" ) {
        //En caso que haya la lista, este el nombre del usuario y no haya registrado su asistencia previamente, registramos su asistencia
        //Realizamos el update al registro de asistencia
        \DB::table('asistencia')
              ->where('id_usuario', $id_usuario)
              ->where('fecha', $fecha)
              ->update(['asistencia' => 1,
                        'fecha_registro' => $hoy]);

        return view("mensajes.mensaje_exito")->with("msj"," Gracias por su asistencia. ");
      }
      elseif ($registro_usuario_asistencia == "1") {
        //Si el valor $registro_usuario_asistencia esta en 1, el usuario ya registro su asistencia
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, usted ya registró su asistencia. ");
      }
      else {
        //Si el valor $registro_usuario_asistencia esta vacio, el usuario no esta en la lista
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, su nombre no está registrado en la lista de fecha $fecha ");
      }
    }
    else {
      return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, no existe una lista de asistencia para la fecha $fecha ");
    }
  }

  public function registrar_falta(Request $request){
    //Tomamos el id del usuario
    $id_usuario = Auth::user()->id;

    //Tomamos la fecha actual
    $date = new Carbon();
    $hoy = Carbon::now();
    $fecha = $hoy->format('Y-m-d');

    //Verificamos que exista una lista de asistencia para el usuario y fecha actual
    $registro_fecha = \DB::table('asistencia')
                              ->where('fecha', $fecha)
                              ->distinct()
                              ->value('fecha');

    if ($registro_fecha != "") {
      //Tomamos el id del usuario que intenta registrar su asistencia
      $registro_usuario_asistencia = \DB::table('asistencia')
                                ->where('id_usuario', $id_usuario)
                                ->where('fecha', $fecha)
                                ->distinct()
                                ->value('asistencia');

      if ($registro_usuario_asistencia == "0" ) {
        //En caso que haya la lista, este el nombre del usuario y no haya registrado su asistencia previamente, registramos su asistencia
        //Realizamos el update al registro de asistencia
        \DB::table('asistencia')
              ->where('id_usuario', $id_usuario)
              ->where('fecha', $fecha)
              ->update(['asistencia' => 0,
                        'observacion' => $request->observacion,
                        'fecha_registro' => $hoy]);

        return view("mensajes.mensaje_exito")->with("msj"," Gracias por indicarnos que no podrá asistir. ");
      }
      elseif ($registro_usuario_asistencia == "1") {
        //Si el valor $registro_usuario_asistencia esta en 1, el usuario ya registro su asistencia
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, usted ya registró su asistencia. ");
      }
      else {
        //Si el valor $registro_usuario_asistencia esta vacio, el usuario no esta en la lista
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, su nombre no está registrado en la lista de fecha $fecha ");
      }
    }
    else {
      return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, no existe una lista de asistencia para la fecha $fecha ");
    }
  }

  public function revisar_asistencia_transportes(){
      //Tomamos la fecha actual
      $date = new Carbon();
      $hoy = Carbon::now();
      $fecha = $hoy->format('Y-m-d');

      $transportes = \DB::table('transportes')
      ->leftjoin('origen', 'origen.id_origen', '=', 'transportes.id_origen')
      ->leftjoin('sub_origen', 'sub_origen.id_sub_origen', '=', 'transportes.id_suborigen')
      ->leftjoin('rel_usuario_transporte', 'rel_usuario_transporte.id_transporte', '=', 'transportes.id_transporte')
      ->leftjoin('asistencia', 'asistencia.id_usuario', '=', 'rel_usuario_transporte.id_usuario')
      ->where('asistencia.fecha', $fecha)
      //->where('personas.id_rol', 16)
      ->orderBy('transportes.distrito', 'ASC')
      ->orderBy('transportes.id_origen', 'ASC')
      ->orderBy('transportes.id_suborigen', 'ASC')
      ->orderBy('transportes.conductor', 'ASC')
      ->orderBy('transportes.propietario', 'ASC')
      ->orderBy('asistencia.asistencia', 'DESC')
      ->get();

      return view("listados.revisar_transportes_asistencia")
            ->with("transportes",$transportes);
  }
}
