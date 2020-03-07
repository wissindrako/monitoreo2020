<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Datatables;
use DateTime;
use Image;
use Auth;
use App\User;
use App\Persona;
use App\Recinto;
use App\Mesa;
use App\UsuarioMesa;
use App\UsuarioRecinto;
use App\UsuarioDistrito;
use App\UsuarioCircunscripcion;
use App\UsuarioTransporte;
use App\UsuarioCasaCampana;

class PersonasController extends Controller
{
    
    public function form_agregar_persona(){
        //carga el formulario para agregar un nueva persona

        if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }

        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();

        $origenes = \DB::table('origen')
        ->where('activo', 1)
        ->get();

        $roles = \DB::table('roles')
        ->where('id', '>=', 15)
        ->get();

        $casas =  \DB::table('casas_campana')
        ->where('casas_campana.activo', 1)
        ->orderBy('circunscripcion', 'asc')
        ->orderBy('distrito', 'asc')
        ->orderBy('id_casa_campana', 'asc')
        ->get();

        $vehiculos = \DB::table('transportes')
        ->where('transportes.activo', 1)
        ->orderBy('id_transporte', 'asc')
        ->get();

        $evidencias = \DB::table('tipo_evidencias')
        ->where('estado', 1)
        ->orderBy('id')
        ->get();


        return view("formularios.form_agregar_persona")
        ->with('circunscripciones', $circunscripciones)
        ->with('origenes', $origenes)
        ->with('roles', $roles)
        ->with('casas', $casas)
        ->with('vehiculos', $vehiculos)
        ->with('evidencias', $evidencias);
    }

    public function agregar_persona(Request $request){

        if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }

        $circunscripciones_listado = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();

        $origenes_listado = \DB::table('origen')
        ->where('activo', 1)
        ->get();

        $roles_listado = \DB::table('roles')
        ->where('id', '>=', 15)
        ->get();

        $casas_listado =  \DB::table('casas_campana')
        ->where('casas_campana.activo', 1)
        ->orderBy('circunscripcion', 'asc')
        ->orderBy('distrito', 'asc')
        ->orderBy('id_casa_campana', 'asc')
        ->get();

        $vehiculos_listado = \DB::table('transportes')
        ->where('transportes.activo', 1)
        ->orderBy('id_transporte', 'asc')
        ->get();

        $evidencias_listado = \DB::table('tipo_evidencias')
        ->where('estado', 1)
        ->orderBy('id')
        ->get();

        if($request->input("nombres") == ''){
            return 'nombres';
        }elseif($request->input("nacimiento") == ''){
            return 'nacimiento';
        }elseif ($request->input("telefono") == '') {
            return 'telefono';
        // }elseif ($request->input("direccion") == '') {
        //     return 'direccion';
        // }elseif ($request->input("grado_compromiso") == '') {
        //     return 'grado_compromiso';
        }elseif ($request->input("id_origen") == '') {
            return 'origen';
        }elseif ($request->input("id_sub_origen") == '') {
            return 'Sub Origen';
        }elseif ($request->input("titularidad") == '') {
            return 'titularidad';
        // }elseif ($request->input("informatico") == '') {
        //     return 'informatico';
        }elseif ($request->input("recinto") == '') {
            return 'recinto';
        }elseif ($request->input("rol_slug") == '') {
            return 'rol';
        }elseif($request->input("rol_slug") == 'conductor' && $request->input("id_vehiculo") == ""){
            return "id_vehiculo";
        }elseif ($request->input("rol_slug") == 'registrador' && $request->input("id_casa_campana") == "") {
            return "id_casa_campana";
        }elseif ($request->input("rol_slug") == 'responsable_mesa' && !$request->has("mesas")) {
            return "mesas";
        }elseif ($request->input("rol_slug") == 'responsable_recinto' && $request->input("recinto") == "") {
            return "recinto";
        }elseif ($request->input("rol_slug") == 'responsable_distrito' && $request->input("recinto") == "") {
            return "recinto";
        }elseif ($request->input("rol_slug") == 'responsable_circunscripcion' && $request->input("recinto") == "") {
            return "recinto";
        }else{}
            
        $reglas=[ 
            'archivo'  => 'mimes:jpg,jpeg,gif,png,bmp | max:2048000'
            ];
            
        $mensajes=[
        'archivo.mimes' => 'El archivo debe ser un archivo con formato: jpg, jpeg, gif, png, bmp',
        'archivo.max' => 'El archivo Supera el tamaño máximo permitido',
        ];

        $validator = Validator::make( $request->all(),$reglas,$mensajes );
        if( $validator->fails() ){ 
            $circunscripciones = \DB::table('recintos')

            ->select('circunscripcion')
            ->distinct()
            ->orderBy('circunscripcion', 'asc')
            ->get();
    
            $origenes = \DB::table('origen')
            ->where('activo', 1)
            ->get();
    
            $roles = \DB::table('roles')
            ->where('id', '>=', 15)
            ->get();
    
            $casas =  \DB::table('casas_campana')
            ->where('casas_campana.activo', 1)
            ->orderBy('circunscripcion', 'asc')
            ->orderBy('distrito', 'asc')
            ->orderBy('id_casa_campana', 'asc')
            ->get();
    
            $vehiculos = \DB::table('transportes')
            ->where('transportes.activo', 1)
            ->orderBy('id_transporte', 'asc')
            ->get();
    
            $evidencias = \DB::table('tipo_evidencias')
            ->where('estado', 1)
            ->orderBy('id')
            ->get();
    
    
            return view("formularios.form_agregar_persona")
            ->with('circunscripciones', $circunscripciones)
            ->with('origenes', $origenes)
            ->with('roles', $roles)
            ->with('casas', $casas)
            ->with('vehiculos', $vehiculos)
            ->with('evidencias', $evidencias)
            ->withErrors($validator)
            ->withInput($request->flash());
        }

        $cedulas = \DB::table('personas')
        ->select('cedula_identidad')
        ->where('cedula_identidad', $request->input("cedula"))
        ->where('complemento_cedula', $request->input("complemento"))
        ->distinct()
        ->get();

        if ($request->paterno == "" && $request->materno == "") {
            return "apellido";
        }else{
            if (count($cedulas) > 0) {
                return "cedula_repetida";
            }else{
                if($request->recinto != ""){
                    $persona=new Persona;
                        
                    $persona->nombre=ucwords(strtolower($request->input("nombres")));
                    $persona->paterno=ucwords(strtolower($request->input("paterno")));
                    $persona->materno=ucwords(strtolower($request->input("materno")));
                    $persona->cedula_identidad=$request->input("cedula");
                    $persona->complemento_cedula=strtoupper($request->input("complemento"));
                    $persona->expedido="LP";
                    $persona->fecha_nacimiento=$request->input("nacimiento");
                    $persona->telefono_celular=$request->input("telefono");
                    // $persona->telefono_referencia=$request->input("telefono_ref");
                    $persona->telefono_referencia="0";
                    // $persona->direccion=ucwords(strtolower($request->input("direccion")));
                    $persona->direccion="";
                    $persona->email="";
                    $persona->grado_compromiso=4;
                    $persona->fecha_registro=date('Y-m-d');
                    $persona->activo=1;
                    $persona->asignado=1;
                    $persona->id_recinto=$request->input("recinto");
                    $persona->id_origen=$request->input("id_origen");
                    $persona->id_sub_origen=$request->input("id_sub_origen");
                    $persona->id_responsable_registro=Auth::user()->id;
                    // $persona->titularidad=$request->input("titularidad");
                    // $persona->informatico=$request->input("informatico");
                    $persona->titularidad="TITULAR";
                    $persona->informatico="SI";
                    $persona->evidencia=$request->input("evidencia");
                    
                    $persona->id_rol=15;
                    
                    //Subimos el archivo
                    if($request->file('archivo') != ""){
                        $tiempo_actual = new DateTime(date('Y-m-d H:i:s'));
                        $archivo = $request->file('archivo');
                        $mime = $archivo->getMimeType();
                        $extension=strtolower($archivo->getClientOriginalExtension());

                        $nuevo_nombre="R-".$request->input("recinto")."-CI-".$request->input("cedula")."-".$tiempo_actual->getTimestamp();

                        $file = $request->file('archivo');

                        $image = Image::make($file->getRealPath());
                        
                        //reducimos la calidad y cambiamos la dimensiones de la nueva instancia.
                        $image->resize(1280, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                        });
                        $image->orientate();

                        $rutadelaimagen="../storage/media/evidencias/".$nuevo_nombre;
        
                        if ($image->save($rutadelaimagen)){


                        //Redirigimos a la vista form_votar_presidencial

                        $persona->archivo_evidencia=$rutadelaimagen;

                        }
                        else{
                            return view("mensajes.msj_error")->with("msj","Ocurrio un error al subir la imagen");
                        }
                    }
    
                    if($persona->save())
                    {
                        $persona = Persona::find($persona->id_persona);
                        $recinto = Recinto::find($request->input("recinto"));

                        $username = $this->ObtieneUsuario($persona->id_persona);
                        // $persona->id_rol =$request->input("id_rol");
                
                        $usuario=new User;
                        $usuario->name=$username;
                        // $email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                        $usuario->email = $username;
                        $usuario->password= bcrypt($username);
                        $usuario->id_persona=$persona->id_persona;
                        $usuario->activo=1;
                
                        if($request->input("rol_slug") == ''){
                            //rol delegado del MAS
                            return 'rol';
                        }elseif($request->input("rol_slug") == 'militante'){
                            //rol delegado del MAS
                            if ($usuario->save()) {

                                $rol = \DB::table('roles')
                                ->where('roles.slug', $request->input("rol_slug"))
                                ->first();

                                // Cambiando el rol de persona
                                $persona->id_rol = $rol->id;
                                //Asignando rol
                                $usuario->assignRole($rol->id);
            
                                if ($persona->save()) {
                                    // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                    return view("formularios.form_agregar_persona")
                                    ->with('circunscripciones', $circunscripciones_listado)
                                    ->with('origenes', $origenes_listado)
                                    ->with('roles', $roles_listado)
                                    ->with('casas', $casas_listado)
                                    ->with('vehiculos', $vehiculos_listado)
                                    ->with('evidencias', $evidencias_listado);
                                } else {
                                    // si no se guarda el update
                                }
                                
                            } else {
                                //si el usuario no se guarda
                                return "failed usuario;";
                            }
                        }elseif ($request->input("rol_slug") == 'conductor') {
                            // rol Conductor
                            if ($request->input("id_vehiculo") != "") {
                                //Si el usuario es creado correctamente modificamos su rol

                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                                        // agregando el rol conductor a persona;
                                    $persona->id_rol = $rol->id;
                                    //Asignando rol el rol conductor al usuario
                                    $usuario->assignRole($rol->id);
                                    if ($persona->save()) {
                                        // creamos las relaciones usuario - transporte
                                        $usuario_transporte = new UsuarioTransporte();
                                        $usuario_transporte->id_usuario = $usuario->id;
                                        $usuario_transporte->id_transporte = $request->input("id_vehiculo");
                                        $usuario_transporte->activo = 1;
                                        if ($usuario_transporte->save()) {
                                            // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                            return view("formularios.form_agregar_persona")
                                            ->with('circunscripciones', $circunscripciones_listado)
                                            ->with('origenes', $origenes_listado)
                                            ->with('roles', $roles_listado)
                                            ->with('casas', $casas_listado)
                                            ->with('vehiculos', $vehiculos_listado)
                                            ->with('evidencias', $evidencias_listado);
                                        } else {
                                            # code...
                                        }
                                    } else {
                                        // si no se guarda el update
                                    }
                                    
                                } else {
                                    //si el usuario no se guarda
                                    return "failed usuario;";
                                }
                                
                            } else {
                                return "id_vehiculo";
                            }
                            // fin Conductor
                        }elseif ($request->input("rol_slug") == 'registrador') {
                            // rol Registrador
                            if ($request->input("id_casa_campana") != "") {
                
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();

                                    // agregando el rol registrador en la tabla persona
                                    $persona->id_rol = $rol->id;

                                    //Asignando rol registrador en la tabla users
                                    $usuario->assignRole($rol->id);
                
                                    if ($persona->save()) {
                                        // creamos las relaciones usuario - recinto
                                        $usuario_casa_campana = new UsuarioCasaCampana();
                                        $usuario_casa_campana->id_usuario = $usuario->id;
                                        $usuario_casa_campana->id_casa_campana = $request->input("id_casa_campana");
                                        $usuario_casa_campana->activo = 1;
                                        if ($usuario_casa_campana->save()) {
                                            // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                            return view("formularios.form_agregar_persona")
                                            ->with('circunscripciones', $circunscripciones_listado)
                                            ->with('origenes', $origenes_listado)
                                            ->with('roles', $roles_listado)
                                            ->with('casas', $casas_listado)
                                            ->with('vehiculos', $vehiculos_listado)
                                            ->with('evidencias', $evidencias_listado);
                                        } else {
                                            return "failed usuario;";
                                        }
                                    } else {
                                        // si no se guarda el update
                                    }
                                    
                                } else {
                                    //si el usuario no se guarda
                                    return "failed usuario;";
                                }
                                
                            } else {
                                return "id_casa_campana";
                            }
                            // fin Registrador
                        }elseif ($request->input("rol_slug") == 'call_center') {
                            //rol Call Center
                            //Si el usuario es creado correctamente modificamos su rol
                            if ($usuario->save()) {

                                $rol = \DB::table('roles')
                                ->where('roles.slug', $request->input("rol_slug"))
                                ->first();

                                // Cambiando el rol de persona
                                $persona->id_rol = $rol->id;
                                //Asignando rol
                                $usuario->assignRole($rol->id);
            
                                if ($persona->save()) {
                                    // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                    return view("formularios.form_agregar_persona")
                                    ->with('circunscripciones', $circunscripciones_listado)
                                    ->with('origenes', $origenes_listado)
                                    ->with('roles', $roles_listado)
                                    ->with('casas', $casas_listado)
                                    ->with('vehiculos', $vehiculos_listado)
                                    ->with('evidencias', $evidencias_listado);
                                } else {
                                    // si no se guarda el update
                                }
                                
                            } else {
                                //si el usuario no se guarda
                                return "failed usuario;";
                            }
                        }elseif ($request->input("rol_slug") == 'responsable_mesa'){
                            //rol responsable_mesa
                            if ($request->has("mesas")) {
                
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                    
                                    $persona->id_rol =$rol->id;
                                    //Asignando rol
                                    $usuario->assignRole($rol->id);
                    
                                    if ($persona->save()) {
                                        // creamos las relaciones usuario - mesas
                                        foreach ($request->mesas as $value) {
                                            $usuario_mesa = new UsuarioMesa;
                                            $usuario_mesa->id_usuario = $usuario->id;
                                            $usuario_mesa->id_mesa = $value;
                                            $usuario_mesa->activo = 1;
                                            $usuario_mesa->save();
                                        }
                                        // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                        return view("formularios.form_agregar_persona")
                                        ->with('circunscripciones', $circunscripciones_listado)
                                        ->with('origenes', $origenes_listado)
                                        ->with('roles', $roles_listado)
                                        ->with('casas', $casas_listado)
                                        ->with('vehiculos', $vehiculos_listado)
                                        ->with('evidencias', $evidencias_listado);
                                    } else {
                                        // si no se guarda el update
                                    }
                                    
                                } else {
                                    //si el usuario no se guarda
                                    return "failed usuario;";
                                }
                                
                            } else {
                                return "mesas";
                            }
                        //fin rol informarico
                        }elseif ($request->input("rol_slug") == 'responsable_recinto') {

                            // rol responsable recinto
                            if ($request->input("recinto") != "") {
                                    
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();

                                    // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol =$rol->id;
                                    //Asignando rol
                                    $usuario->assignRole($rol->id);
                                    if ($persona->save()) {
                                        // creamos las relaciones usuario - recinto
                                        $usuario_recinto = new UsuarioRecinto;
                                        $usuario_recinto->id_usuario = $usuario->id;
                                        $usuario_recinto->id_recinto = $request->input("recinto");
                                        $usuario_recinto->activo = 1;
                                        if ($usuario_recinto->save()) {
                                            // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                            return view("formularios.form_agregar_persona")
                                            ->with('circunscripciones', $circunscripciones_listado)
                                            ->with('origenes', $origenes_listado)
                                            ->with('roles', $roles_listado)
                                            ->with('casas', $casas_listado)
                                            ->with('vehiculos', $vehiculos_listado)
                                            ->with('evidencias', $evidencias_listado);
                                        } else {
                                            # code...
                                        }
                                    } else {
                                        // si no se guarda el update
                                    }
                                    
                                } else {
                                    //si el usuario no se guarda
                                    return "failed usuario;";
                                }
                                
                            } else {
                                return "recinto";
                            }
                            // finresponsable recinto
                        }elseif ($request->input("rol_slug") == 'responsable_distrito') {
                            //rol Responsable de Distrito
                            
                            if ($request->input("recinto") != "") {
                
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                                        // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol =$rol->id;
                                    //Asignando rol
                                    $usuario->assignRole($rol->id);
                    
                                    if ($persona->save()) {
                                        // creamos las relaciones usuario - recinto
                                        $usuario_distrito = new UsuarioDistrito;
                                        $usuario_distrito->id_usuario = $usuario->id;
                                        $usuario_distrito->id_distrito = $recinto->distrito;
                                        $usuario_distrito->activo = 1;
                                        if ($usuario_distrito->save()) {
                                            // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                            return view("formularios.form_agregar_persona")
                                            ->with('circunscripciones', $circunscripciones_listado)
                                            ->with('origenes', $origenes_listado)
                                            ->with('roles', $roles_listado)
                                            ->with('casas', $casas_listado)
                                            ->with('vehiculos', $vehiculos_listado)
                                            ->with('evidencias', $evidencias_listado);
                                        } else {
                                            # code...
                                        }
                                    } else {
                                        // si no se guarda el update
                                    }
                                    
                                } else {
                                    //si el usuario no se guarda
                                    return "failed usuario;";
                                }
                                
                            } else {
                                return "distrito";
                            }
                            //fin Responsable de Distrito
                        }elseif ($request->input("rol_slug") == 'responsable_circunscripcion') {
                            //rol Responsable Circunscripcion
                            if ($request->input("recinto") != "") {
                    
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {

                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                                        // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol =$rol->id;
                                    //Asignando rol
                                    $usuario->assignRole($rol->id);
                
                                    if ($persona->save()) {
                                        // creamos las relaciones usuario - recinto
                                        $usuario_circunscripcion = new UsuarioCircunscripcion;
                                        $usuario_circunscripcion->id_usuario = $usuario->id;
                                        $usuario_circunscripcion->id_circunscripcion = $recinto->circunscripcion;
                                        $usuario_circunscripcion->activo = 1;
                                        if ($usuario_circunscripcion->save()) {
                                            // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                                            return view("formularios.form_agregar_persona")
                                            ->with('circunscripciones', $circunscripciones_listado)
                                            ->with('origenes', $origenes_listado)
                                            ->with('roles', $roles_listado)
                                            ->with('casas', $casas_listado)
                                            ->with('vehiculos', $vehiculos_listado)
                                            ->with('evidencias', $evidencias_listado);
                                        } else {
                                            # code...
                                        }
                                    } else {
                                        // si no se guarda el update
                                    }
                                    
                                } else {
                                    //si el usuario no se guarda
                                    return "failed usuario;";
                                }
                                
                            } else {
                                return "circunscripcion";
                            }
                            // fin Responsable Circunscripcion
                        }else{
                
                        }

                        // return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                        return view("formularios.form_agregar_persona")
                        ->with('circunscripciones', $circunscripciones_listado)
                        ->with('origenes', $origenes_listado)
                        ->with('roles', $roles_listado)
                        ->with('casas', $casas_listado)
                        ->with('vehiculos', $vehiculos_listado)
                        ->with('evidencias', $evidencias_listado);
                    }else{
                        return "failed";
                    }
                }
                else{
                    return "recinto";
                }
            }
        }
    }


    public function form_editar_persona($id_persona){
        //carga el formulario para agregar un nueva persona
        if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }

        // $persona = Persona::find($id_persona);
        $persona = \DB::table('personas')
        ->join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->where('personas.id_persona', $id_persona)
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
                 'recintos.zona', 'recintos.direccion as direccion_recinto',
                 'origen.origen', 'sub_origen.nombre as sub_origen',
                 'roles.name as nombre_rol'
        )
        ->orderBy('fecha_registro', 'desc')
        ->orderBy('id_persona', 'desc')
        ->first();

        $usuario = \DB::table('users')
        ->where('id_persona', $id_persona)
        ->select('id')
        ->first();

        $circunscripcion = \DB::table('recintos')
        ->where('id_recinto', $persona->id_recinto)
        ->select('circunscripcion')
        ->distinct()
        ->first();

        $distrito = \DB::table('recintos')
        ->where('id_recinto', $persona->id_recinto)
        ->select('distrito')
        ->distinct()
        ->first();

        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();
        
        $distritos = \DB::table('recintos')
        ->where('circunscripcion', $circunscripcion->circunscripcion)
        ->select('distrito')
        ->distinct()
        ->orderBy('distrito', 'asc')
        ->get();

        $recintos = \DB::table('recintos')
        ->where('circunscripcion', $circunscripcion->circunscripcion)
        ->where('distrito', $distrito->distrito)
        ->select('id_recinto', 'nombre as nombre_recinto')
        // ->distinct()
        ->orderBy('id_recinto', 'asc')
        ->get();

        $origenes = \DB::table('origen')
        ->where('activo', 1)
        ->get();

        $sub_origenes = \DB::table('sub_origen')
        ->where('id_origen', $persona->id_origen)
        ->where('activo', 1)
        ->get();

        $roles = \DB::table('roles')
        ->where('id', '>=', 15)
        ->get();

        $casas =  \DB::table('casas_campana')
        ->where('casas_campana.activo', 1)
        ->orderBy('circunscripcion', 'asc')
        ->orderBy('distrito', 'asc')
        ->orderBy('id_casa_campana', 'asc')
        ->get();

        $casa_campana =  \DB::table('rel_usuario_campana')
        ->where('activo', 1)
        ->where('id_usuario', $usuario->id)
        ->select('id_casa_campana')
        ->first();

        $vehiculos = \DB::table('transportes')
        ->where('transportes.activo', 1)
        ->orderBy('id_transporte', 'asc')
        ->get();

        $usuario_vehiculo = \DB::table('rel_usuario_transporte')
        ->where('activo', 1)
        ->where('id_usuario', $usuario->id)
        ->select('id_transporte')
        ->first();

        $mesas_usuario =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        // ->where(function($query){
        //     $query
        //     ->where('rel_usuario_mesa.activo', null)
        //     ->orwhere('rel_usuario_mesa.activo', 1);
        // })
        ->where('id_usuario', $usuario->id)
        ->where('rel_usuario_mesa.activo', 1)
        // ->whereNotIn('mesas.id_mesa', $mesas_recinto)
        ->select('users.id as id_usuario',
                 'rel_usuario_mesa.id_mesa as rel_idmesa', 'rel_usuario_mesa.activo as mesa_activa',
                 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito', 'recintos.zona',
                 'mesas.id_mesa', 'mesas.id_recinto', 'codigo_mesas_oep', 'codigo_ajllita',
                 'personas.telefono_celular',
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
                )
        ->orderBy('mesas.id_mesa')
        ->get();

        
        $evidencias = \DB::table('tipo_evidencias')
        ->where('estado', 1)
        ->orderBy('id')
        ->get();

        return view("formularios.form_editar_persona")
        ->with('persona', $persona)
        ->with('usuario', $usuario)
        ->with('circunscripciones', $circunscripciones)
        ->with('distritos', $distritos)
        ->with('recintos', $recintos)
        ->with('origenes', $origenes)
        ->with('sub_origenes', $sub_origenes)
        ->with('roles', $roles)
        ->with('casas', $casas)
        ->with('casa_campana', $casa_campana)
        ->with('vehiculos', $vehiculos)
        ->with('usuario_vehiculo', $usuario_vehiculo)
        ->with('mesas_usuario', $mesas_usuario)
        ->with('evidencias', $evidencias)
        ;
    }

    public function editar_persona(Request $request){
        if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }

        if($request->input("nombres") == ''){
            return 'nombres';
        }elseif($request->paterno == "" && $request->materno == ""){
            return 'apellido';
        }elseif($request->input("cedula") == ''){
            return 'nacimiento';
        }elseif($request->input("nacimiento") == ''){
            return 'nacimiento';
        }elseif ($request->input("telefono") == '' && $request->input("telefono_ref") == '') {
            return 'telefono';
        }elseif ($request->input("direccion") == '') {
            return 'direccion';
        }else{}

        $id_persona = $request->input("id_persona");
        $persona = Persona::find($id_persona);
        
        if ($request->input("cedula") != $persona->cedula_identidad || $request->input("complemento") != $persona->complemento_cedula) {
            $cedulas = \DB::table('personas')
            ->select('cedula_identidad')
            ->where('cedula_identidad', $request->input("cedula"))
            ->where('complemento_cedula', $request->input("complemento"))
            ->distinct()
            ->get();
        }else{
            $cedulas = [];
        }

        if (count($cedulas) > 0) {
            return "cedula_repetida";
        }else{
            $persona->nombre=ucwords(strtolower($request->input("nombres")));
            $persona->paterno=ucwords(strtolower($request->input("paterno")));
            $persona->materno=ucwords(strtolower($request->input("materno")));
            $persona->cedula_identidad=$request->input("cedula");
            $persona->complemento_cedula=strtoupper($request->input("complemento"));
            $persona->expedido=$request->input("expedido");
            $persona->fecha_nacimiento=$request->input("nacimiento");
            $persona->telefono_celular=$request->input("telefono");
            $persona->telefono_referencia=$request->input("telefono_ref");
            $persona->direccion=ucwords(strtolower($request->input("direccion")));
            
            $persona->email=$request->input("email");

            if($persona->save())
            {
                return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
            }else{
                return "failed";
            }
        }
    }

    public function editar_asignacion_persona(Request $request){
        if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }

        $id_persona = $request->input("id_persona");
        $persona = Persona::find($id_persona);
        
        if ($request->input("rol_slug") == '') {
            return 'rol';
        // }elseif ($request->input("grado_compromiso") == "") {
        //     return "grado_compromiso";
        }elseif ($request->input("recinto") == "") {
            return "recinto";
        }elseif($request->input("rol_slug") == 'conductor' && $request->input("id_vehiculo") == ""){
            return "id_vehiculo";
        }elseif ($request->input("rol_slug") == 'registrador' && $request->input("id_casa_campana") == "") {
            return "id_casa_campana";
        }elseif ($request->input("rol_slug") == 'responsable_mesa' && !$request->has("mesas")) {
            return "mesas";
        }elseif ($request->input("rol_slug") == 'responsable_recinto' && $request->input("recinto") == "") {
            return "recinto";
        }elseif ($request->input("rol_slug") == 'responsable_distrito' && $request->input("recinto") == "") {
            return "recinto";
        }elseif ($request->input("rol_slug") == 'responsable_circunscripcion' && $request->input("recinto") == "") {
            return "recinto";
        }else {
            # code...
        }
      
        if($request->recinto != ""){

            $persona->grado_compromiso=$request->input("grado_compromiso");
            
            $persona->id_origen=$request->input("id_origen");
            $persona->id_sub_origen=$request->input("id_sub_origen");
            $persona->id_responsable_registro=Auth::user()->id;
            // $persona->informatico=$request->input("informatico");
            $persona->titularidad=$request->input("titularidad");
            $recinto = Recinto::find($request->input("recinto"));
            $persona->evidencia=$request->input("evidencia");
            // Obteniendo los datos del Usuario segun el id_persona
            $usuario = \DB::table('users')
            ->where('id_persona', $request->input('id_persona'))
            ->first();
            //Cambiando el metodo de identificar usuario para usar el revoke
            $usuario=User::find($usuario->id);

            $rol = \DB::table('roles')
            ->where('roles.slug', $request->input("rol_slug"))
            ->first();

            $rol_actual = \DB::table('roles')
            ->where('id', $persona->id_rol)
            ->first();
             
            if ($persona->id_rol != $rol->id) {
                // si el rol cambia


                //Revocando el Rol de la tabla role_user
                $usuario->revokeRole($rol_actual->id);

                //Rol Actual a liberar
                if ($rol_actual->slug == 'militante') {
                    # militantes...
                }elseif ($rol_actual->slug == 'conductor') {
                    # conductor

                    //Quitando el rol de la relacion usuario_transporte
                    if (\DB::table('rel_usuario_transporte')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}
                }elseif ($rol_actual->slug == 'registrador') {
                    # Registrador

                    //Quitando el rol de la relacion usuario_casa_campaña
                    if (\DB::table('rel_usuario_campana')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}
                }elseif ($rol_actual->slug == 'call_center') {
                    # Call center
                }elseif ($rol_actual->slug == 'responsable_mesa') {
                    # ResponsableMesa
                    if (UsuarioMesa::where('id_usuario', $usuario->id)->delete()){}
                }elseif ($rol_actual->slug == 'responsable_recinto') {
                    # ResponsableRecinto
                    if (\DB::table('rel_usuario_recinto')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}
                }elseif ($rol_actual->slug == 'responsable_distrito') {
                    # ResponsableDistrito
                    if (\DB::table('rel_usuario_distrito')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}
                }elseif ($rol_actual->slug == 'responsable_circunscripcion') {
                    # ResponsableCircunscripcion
                    if (\DB::table('rel_usuario_circunscripcion')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}
                }  else {
                    # code...
                }

                $persona->id_recinto = $request->input("recinto");

                if($request->input("rol_slug") == 'militante'){
                    //rol delegado del MAS
                    $persona->id_rol = $rol->id;
                    if ($persona->save()) {
                        return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                    }
                }elseif ($request->input("rol_slug") == 'conductor') {
                    // rol Conductor
                    if ($request->input("id_vehiculo") != "") {
                        //Si el usuario es creado correctamente modificamos su rol

                        if ($usuario->save()) {
            
                            $rol = \DB::table('roles')
                            ->where('roles.slug', $request->input("rol_slug"))
                            ->first();
                                // agregando el rol conductor a persona;
                            $persona->id_rol = $rol->id;
                            //Asignando rol el rol conductor al usuario
                            $usuario->assignRole($rol->id);
                            if ($persona->save()) {
                                // creamos las relaciones usuario - transporte
                                $usuario_transporte = new UsuarioTransporte();
                                $usuario_transporte->id_usuario = $usuario->id;
                                $usuario_transporte->id_transporte = $request->input("id_vehiculo");
                                $usuario_transporte->activo = 1;
                                if ($usuario_transporte->save()) {
                                    return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                                } else {
                                    # code...
                                }
                            } else {
                                // si no se guarda el update
                            }
                            
                        } else {
                            //si el usuario no se guarda
                            return "failed usuario;";
                        }
                        
                    } else {
                        return "id_vehiculo";
                    }
                    // fin Conductor
                }elseif ($request->input("rol_slug") == 'registrador') {
                    // rol Registrador
                    if ($request->input("id_casa_campana") != "") {
        
                        //Si el usuario es creado correctamente modificamos su rol
                        if ($usuario->save()) {
            
                            $rol = \DB::table('roles')
                            ->where('roles.slug', $request->input("rol_slug"))
                            ->first();

                            // agregando el rol registrador en la tabla persona
                            $persona->id_rol = $rol->id;

                            //Asignando rol registrador en la tabla users
                            $usuario->assignRole($rol->id);
        
                            if ($persona->save()) {
                                // creamos las relaciones usuario - casa de campaña
                                $usuario_casa_campana = new UsuarioCasaCampana();
                                $usuario_casa_campana->id_usuario = $usuario->id;
                                $usuario_casa_campana->id_casa_campana = $request->input("id_casa_campana");
                                $usuario_casa_campana->activo = 1;
                                if ($usuario_casa_campana->save()) {
                                    return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                                } else {
                                    return "failed usuario;";
                                }
                            } else {
                                // si no se guarda el update
                            }
                            
                        } else {
                            //si el usuario no se guarda
                            return "failed usuario;";
                        }
                        
                    } else {
                        return "id_casa_campana";
                    }
                    // fin Registrador
                }elseif ($request->input("rol_slug") == 'call_center') {
                    //rol Call Center
                    //Si el usuario es creado correctamente modificamos su rol
                    if ($usuario->save()) {

                        $rol = \DB::table('roles')
                        ->where('roles.slug', $request->input("rol_slug"))
                        ->first();

                        // Cambiando el rol de persona
                        $persona->id_rol = $rol->id;
                        //Asignando rol
                        $usuario->assignRole($rol->id);
    
                        if ($persona->save()) {
                            return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                        } else {
                            // si no se guarda el update
                        }
                        
                    } else {
                        //si el usuario no se guarda
                        return "failed usuario;";
                    }
                }elseif ($request->input("rol_slug") == 'responsable_mesa'){
                    //rol responsable_mesa
                    if ($request->has("mesas")) {
        
                        //Si el usuario es creado correctamente modificamos su rol
                        if ($usuario->save()) {
            
                            $rol = \DB::table('roles')
                            ->where('roles.slug', $request->input("rol_slug"))
                            ->first();
            
                            $persona->id_rol =$rol->id;
                            //Asignando rol
                            $usuario->assignRole($rol->id);
            
                            if ($persona->save()) {
                                // creamos las relaciones usuario - mesas
                                foreach ($request->mesas as $value) {
                                    $usuario_mesa = new UsuarioMesa;
                                    $usuario_mesa->id_usuario = $usuario->id;
                                    $usuario_mesa->id_mesa = $value;
                                    $usuario_mesa->activo = 1;
                                    $usuario_mesa->save();
                                }
                                return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                            } else {
                                // si no se guarda el update
                            }
                            
                        } else {
                            //si el usuario no se guarda
                            return "failed usuario;";
                        }
                        
                    } else {
                        return "mesas";
                    }
                //fin rol informarico
                }elseif ($request->input("rol_slug") == 'responsable_recinto') {

                    // rol responsable recinto
                    if ($request->input("recinto") != "") {
                            
                        //Si el usuario es creado correctamente modificamos su rol
                        if ($usuario->save()) {
            
                            $rol = \DB::table('roles')
                            ->where('roles.slug', $request->input("rol_slug"))
                            ->first();

                            // $persona->id_rol =$request->input("id_rol");
                            $persona->id_rol =$rol->id;
                            //Asignando rol
                            $usuario->assignRole($rol->id);
        
                            if ($persona->save()) {
                                // creamos las relaciones usuario - recinto
                                $usuario_recinto = new UsuarioRecinto;
                                $usuario_recinto->id_usuario = $usuario->id;
                                $usuario_recinto->id_recinto = $request->input("recinto");
                                $usuario_recinto->activo = 1;
                                if ($usuario_recinto->save()) {
                                    return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                                } else {
                                    # code...
                                }
                            } else {
                                // si no se guarda el update
                            }
                            
                        } else {
                            //si el usuario no se guarda
                            return "failed usuario;";
                        }
                        
                    } else {
                        return "recinto";
                    }
                    // finresponsable recinto
                }elseif ($request->input("rol_slug") == 'responsable_distrito') {
                    //rol Responsable de Distrito
                    if ($request->input("recinto") != "") {
        
                        //Si el usuario es creado correctamente modificamos su rol
                        if ($usuario->save()) {
            
                            $rol = \DB::table('roles')
                            ->where('roles.slug', $request->input("rol_slug"))
                            ->first();
                                // $persona->id_rol =$request->input("id_rol");
                            $persona->id_rol =$rol->id;
                            //Asignando rol
                            $usuario->assignRole($rol->id);
            
                            if ($persona->save()) {
                                // creamos las relaciones usuario - recinto
                                $usuario_distrito = new UsuarioDistrito;
                                $usuario_distrito->id_usuario = $usuario->id;
                                $usuario_distrito->id_distrito = $recinto->distrito;
                                $usuario_distrito->activo = 1;
                                if ($usuario_distrito->save()) {
                                    return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                                } else {
                                    # code...
                                }
                            } else {
                                // si no se guarda el update
                            }
                            
                        } else {
                            //si el usuario no se guarda
                            return "failed usuario;";
                        }
                        
                    } else {
                        return "distrito";
                    }
                    //fin Responsable de Distrito
                }elseif ($request->input("rol_slug") == 'responsable_circunscripcion') {
                    //rol Responsable Circunscripcion
                    if ($request->input("recinto") != "") {
            
                        //Si el usuario es creado correctamente modificamos su rol
                        if ($usuario->save()) {

                            $rol = \DB::table('roles')
                            ->where('roles.slug', $request->input("rol_slug"))
                            ->first();
                                // $persona->id_rol =$request->input("id_rol");
                            $persona->id_rol =$rol->id;
                            //Asignando rol
                            $usuario->assignRole($rol->id);
        
                            if ($persona->save()) {
                                // creamos las relaciones usuario - circ
                                $usuario_circunscripcion = new UsuarioCircunscripcion;
                                $usuario_circunscripcion->id_usuario = $usuario->id;
                                $usuario_circunscripcion->id_circunscripcion = $recinto->circunscripcion;
                                $usuario_circunscripcion->activo = 1;
                                if ($usuario_circunscripcion->save()) {
                                    return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                                } else {
                                    # code...
                                }
                            } else {
                                // si no se guarda el update
                            }
                            
                        } else {
                            //si el usuario no se guarda
                            return "failed usuario;";
                        }
                        
                    } else {
                        return "circunscripcion";
                    }
                    // fin Responsable Circunscripcion
                }else{
        
                }


            } else {
                // Si el rol no cambia
                if ($persona->id_recinto != $request->input("recinto")) {
                    //Si el recinto cambia
                    
                    //Rol Actual a liberar
                if ($request->input("rol_slug") == 'militante') {
                    # militantes...
                    $persona->id_recinto = $request->input("recinto");

                }elseif ($request->input("rol_slug") == 'conductor') {
                    # conductor
                    $persona->id_recinto = $request->input("recinto");

                }elseif ($request->input("rol_slug") == 'registrador') {
                    # Registrador
                    $usuario_casa_campana = new UsuarioCasaCampana();
                    $usuario_casa_campana->id_usuario = $usuario->id;
                    $usuario_casa_campana->id_casa_campana = $request->input("id_casa_campana");
                    $usuario_casa_campana->activo = 1;
                    
                    if ($usuario_casa_campana->save()) {
                        $persona->id_recinto = $request->input("recinto");
                    }

                }elseif ($request->input("rol_slug") == 'call_center') {
                    # Call center
                    $persona->id_recinto = $request->input("recinto");

                }elseif ($request->input("rol_slug") == 'responsable_mesa') {
                    if (UsuarioMesa::where('id_usuario', $usuario->id)->delete()){}
                    # ResponsableMesa
                    foreach ($request->mesas as $value) {
                        $usuario_mesa = new UsuarioMesa;
                        $usuario_mesa->id_usuario = $usuario->id;
                        $usuario_mesa->id_mesa = $value;
                        $usuario_mesa->activo = 1;
                        $usuario_mesa->save();
                    }
                    $persona->id_recinto = $request->input("recinto");

                }elseif ($request->input("rol_slug") == 'responsable_recinto') {
                    # ResponsableRecinto
                    if (\DB::table('rel_usuario_recinto')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}

                    $usuario_recinto = new UsuarioRecinto;
                    $usuario_recinto->id_usuario = $usuario->id;
                    $usuario_recinto->id_recinto = $request->input("recinto");
                    $usuario_recinto->activo = 1;
                    if ($usuario_recinto->save()) {
                        $persona->id_recinto = $request->input("recinto");
                    }

                }elseif ($request->input("rol_slug") == 'responsable_distrito') {
                    # ResponsableDistrito
                    if (\DB::table('rel_usuario_recinto')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}

                    $usuario_distrito = new UsuarioDistrito;
                    $usuario_distrito->id_usuario = $usuario->id;
                    $usuario_distrito->id_distrito = $recinto->distrito;
                    $usuario_distrito->activo = 1;
                    if ($usuario_distrito->save()) {
                        $persona->id_recinto = $request->input("recinto");
                    }

                }elseif ($request->input("rol_slug") == 'responsable_circunscripcion') {
                    # ResponsableCircunscripcion
                    if (\DB::table('rel_usuario_circunscripcion')
                    ->where('id_usuario', $usuario->id)
                    ->delete()) {}
                    // creamos las relaciones usuario - circ
                    $usuario_circunscripcion = new UsuarioCircunscripcion;
                    $usuario_circunscripcion->id_usuario = $usuario->id;
                    $usuario_circunscripcion->id_circunscripcion = $recinto->circunscripcion;
                    $usuario_circunscripcion->activo = 1;
                    if ($usuario_circunscripcion->save()) {
                        $persona->id_recinto = $request->input("recinto");
                    }
                }  else {
                    # code...
                }

                $persona->id_recinto=$request->input("recinto");
                if($persona->save())
                {
                    return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                }else{
                    return "failed";
                }

                } else {
                    //Si el recinto no cambia

                    if ($request->input("rol_slug") == 'registrador') {
                        # Registrador
                        //Quitando la relacion usuario casa de campaña
                        if (\DB::table('rel_usuario_campana')
                        ->where('id_usuario', $usuario->id)
                        ->delete()) {}
                        //Agregando la relacion usuario casa de campaña
                        $usuario_casa_campana = new UsuarioCasaCampana();
                        $usuario_casa_campana->id_usuario = $usuario->id;
                        $usuario_casa_campana->id_casa_campana = $request->input("id_casa_campana");
                        $usuario_casa_campana->activo = 1;
                        
                        if ($usuario_casa_campana->save()) {
                            $persona->id_recinto = $request->input("recinto");
                        }
    
                    }elseif ($request->input("rol_slug") == 'conductor') {
                        # Call center
                        //Revocando relacion usuario transporte
                        if (\DB::table('rel_usuario_transporte')
                        ->where('id_usuario', $usuario->id)
                        ->delete()) {}

                        // Agregando relacion usuario transporte
                        $usuario_transporte = new UsuarioTransporte();
                        $usuario_transporte->id_usuario = $usuario->id;
                        $usuario_transporte->id_transporte = $request->input("id_vehiculo");
                        $usuario_transporte->activo = 1;
                        if ($usuario_transporte->save()) {
                            return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                        }
    
                    }elseif ($request->input("rol_slug") == 'responsable_mesa') {
                        if (UsuarioMesa::where('id_usuario', $usuario->id)->delete()){}
                        # ResponsableMesa
                        foreach ($request->mesas as $value) {
                            $usuario_mesa = new UsuarioMesa;
                            $usuario_mesa->id_usuario = $usuario->id;
                            $usuario_mesa->id_mesa = $value;
                            $usuario_mesa->activo = 1;
                            $usuario_mesa->save();
                        }
                        $persona->id_recinto = $request->input("recinto");
                    }


                    if($persona->save())
                    {
                        return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                    }else{
                        return "failed";
                    }

                }
                
            }

        }
        else{
            return "recinto";
        }
    }

    
    public function editar_evidencia_persona(Request $request){

        // return $request->input("id_persona");
            
        $id_persona = $request->input("id_persona");
        $persona = Persona::find($id_persona);
    
        //Primero validamos el archivo
        $reglas=[ 
            'archivo'  => 'mimes:jpg,jpeg,gif,png,bmp | max:2048000'
            ];
            
        $mensajes=[
        'archivo.mimes' => 'El archivo debe ser un archivo con formato: jpg, jpeg, gif, png, bmp.',
        'archivo.max' => 'El archivo Supera el tamaño máximo permitido',
        ];

        $validator = Validator::make( $request->all(),$reglas,$mensajes );
        if( $validator->fails() ){ 

          return view("formularios.form_votar_presidencial_subir_imagen")
          ->with("persona",$persona)
          ->withErrors($validator)
          ->withInput($request->flash());
        }
    
        
        //Subimos el archivo
        if($request->file('archivo') != ""){
            $tiempo_actual = new DateTime(date('Y-m-d H:i:s'));
            $archivo = $request->file('archivo');
            $mime = $archivo->getMimeType();
            $extension=strtolower($archivo->getClientOriginalExtension());

            $nuevo_nombre="R-".$persona->id_recinto."-CI-".$persona->cedula_identidad."-".$tiempo_actual->getTimestamp();

            $file = $request->file('archivo');

            $image = Image::make($file->getRealPath());
            
            //reducimos la calidad y cambiamos la dimensiones de la nueva instancia.
            $image->resize(1280, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            });
            $image->orientate();

            $rutadelaimagen="../storage/media/evidencias/".$nuevo_nombre;

            if ($image->save($rutadelaimagen)){


            //Redirigimos a la vista f

            $persona->archivo_evidencia=$rutadelaimagen;
            $persona->save();

            }
            else{
                return view("mensajes.msj_error")->with("msj","Ocurrio un error al subir la imagen");
            }
        }
        else{
            return $request->file('archivo');
        }
      }

    public function form_baja_persona($id_persona){
        if(\Auth::user()->isRole('admin')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }
        //carga el formulario para agregar un nueva persona

        $persona = Persona::find($id_persona);

        return view("formularios.form_baja_persona")
        ->with('persona', $persona);
    }

    public function baja_persona(Request $request){
        if(\Auth::user()->isRole('admin')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }
        $id_persona = $request->input("id_persona");
        $persona = Persona::find($id_persona);
        $persona->activo = 0;

        if ($persona->save()) {
            return "ok";
        } else {
            return "failed";
        }
    }

    public function listado_personas_asignacion(){
        if(\Auth::user()->isRole('admin')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }
        $personas = [];
        return view("listados.listado_personas_asignacion")
        ->with('personas', $personas);
    }
    
    // public function buscar_persona_asignacion(Request $request){
    //     $dato = $request->input("dato_buscado");
    //     $personas = Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
    //     ->leftjoin('users', 'personas.id_persona', 'users.id_persona')
    //     ->join('origen', 'personas.id_origen', 'origen.id_origen')
    //     ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
    //     ->leftjoin('roles', 'personas.id_rol', 'roles.id')
    //     ->where("personas.nombre","like","%".$dato."%")
    //     ->orwhere("paterno","like","%".$dato."%")
    //     ->orwhere("materno","like","%".$dato."%")
    //     ->orwhere("cedula_identidad","like","%".$dato."%")
    //     ->orwhere("roles.slug","like","%".$dato."%")
    //     ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
    //     'recintos.zona', 'recintos.direccion as direccion_recinto',
    //     'origen.origen', 'sub_origen.nombre as sub_origen',
    //     'roles.name as nombre_rol',
    //     'users.activo as usuario_activo', 'users.name as codigo_usuario'
    //     )
    //     ->orderBy('id_persona', 'desc')
    //     // ->paginate(30);
    //     // return view('listados.listado_personas_asignacion')->with("personas",$personas);
    //     ->get();
    //     return $personas;
    // }

    public function buscar_persona_asignacion(){
        if(\Auth::user()->isRole('admin')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }
        return Datatables::of(Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->leftjoin('users', 'personas.id_persona', 'users.id_persona')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
        'recintos.zona', 'recintos.direccion as direccion_recinto',
        'origen.origen', 'sub_origen.nombre as sub_origen',
        'roles.name as nombre_rol',
        'users.activo as usuario_activo', 'users.name as codigo_usuario'
        )
        ->get())->make(true);
    }

    public function listado_personas(){
        if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        }
        $personas = \DB::table('personas')
        ->join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
                 'recintos.zona', 'recintos.direccion as direccion_recinto',
                 'origen.origen', 'sub_origen.nombre as sub_origen',
                 'roles.name as nombre_rol', 'roles.description'
        )
        ->orderBy('fecha_registro', 'desc')
        ->orderBy('id_persona', 'desc')
        ->get();

        $id_usuario = Auth::user()->id;
        $rol = \DB::table('role_user')
        ->join('roles', 'role_user.role_id', 'roles.id')
        ->where('user_id', $id_usuario)
        ->first();

        return view("listados.listado_personas")
        ->with('personas', $personas)
        ->with('rol', $rol);
    }
    
    // public function buscar_persona(Request $request){
    //     $dato = $request->input("dato_buscado");
    //     $personas = Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
    //     ->join('origen', 'personas.id_origen', 'origen.id_origen')
    //     ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
    //     ->leftjoin('roles', 'personas.id_rol', 'roles.id')
    //     ->where("personas.nombre","like","%".$dato."%")
    //     ->orwhere("paterno","like","%".$dato."%")
    //     ->orwhere("materno","like","%".$dato."%")
    //     ->orwhere("cedula_identidad","like","%".$dato."%")
    //     ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
    //     'recintos.zona', 'recintos.direccion as direccion_recinto',
    //     'origen.origen', 'sub_origen.nombre as sub_origen',
    //     'roles.name as nombre_rol'
    //     )
    //     ->orderBy('fecha_registro', 'desc')
    //     ->orderBy('id_persona', 'desc')
    //     ->paginate(100);
    //     return view('listados.listado_personas')->with("personas",$personas);
    // }

    public function buscar_persona(){
        return Datatables::of(Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->leftjoin('tipo_evidencias', 'personas.evidencia', 'tipo_evidencias.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito', 'recintos.distrito_referencial',
        'recintos.zona', 'recintos.direccion as direccion_recinto',
        'origen.origen', 'sub_origen.nombre as sub_origen',
        'roles.name as nombre_rol', 'roles.description',
        'tipo_evidencias.nombre as nombre_evidencia',
        \DB::raw('CONCAT(personas.telefono_celular," - ", personas.telefono_referencia) as contacto'),
        \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
        \DB::raw('CONCAT(personas.telefono_celular," - ", personas.telefono_referencia) as contacto'),
        \DB::raw('CONCAT(personas.cedula_identidad," - ", personas.complemento_cedula) as ci')
        )
        ->get())->make(true);
    }

    public function ConsultaSubOrigen($id_origen){
        $sub_origenes = \DB::table('sub_origen')
        ->where('id_origen', $id_origen)
        ->where('activo', 1)
        // ->distinct()
        ->orderBy('nombre')
        ->get();
        return $sub_origenes;
    }

    public function consultaUsuarioRegistrado($cedula){
        // if(\Auth::user()->isRole('registrador')==false && \Auth::user()->isRole('admin')==false && \Auth::user()->isRole('responsable_circunscripcion')==false){
        //     return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">#!<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Acceso restringido </label>   </div></div> ') ;
        // }
        $personas = \DB::table('personas')
        ->join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
                 'recintos.zona', 'recintos.direccion as direccion_recinto',
                 'origen.origen', 'sub_origen.nombre as sub_origen',
                 'roles.name as nombre_rol', 'roles.description',
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
                 \DB::raw('CONCAT(personas.telefono_celular," - ", personas.telefono_referencia) as contacto'),
                 \DB::raw('CONCAT(personas.cedula_identidad," - ", personas.complemento_cedula) as ci'),
                 \DB::raw('CONCAT("C: ", recintos.circunscripcion," - Dist. Municipal: ", recintos.distrito," - Dist. OEP: ", recintos.distrito_referencial," - R: ", recintos.nombre) as recinto')
        )
        ->where('cedula_identidad', $cedula)
        ->orderBy('fecha_registro', 'desc')
        ->orderBy('id_persona', 'desc')
        ->get();

        return $personas;
    }

    public function ObtieneUsuario($id_persona){
        $persona = Persona::find($id_persona);
    
        $ci = $persona->cedula_identidad.$persona->complemento_cedula;
        $numero = 0;
        $username = $ci;
        while (User::where('name', '=', $username)->exists()) { // user found 
            $username=$username+$numero;
            $numero++;
        }
    
        //Quitar espacios en blanco
        $username = str_replace(' ', '', $username); 
        return $username;
    }
}
