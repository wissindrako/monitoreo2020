<?php

namespace App\Http\Controllers;

use App\CasaCampana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Auth;
use Datatables;
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

class MesasController extends Controller
{
    public function detalle_editar_mesa(Request $request){
        if ($request->input_voto == "") { # code...
            return 'sin_valor';
        } else {
          // return \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 1)->get();
          if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', $request->id_partido)->get()) > 0) {
            \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', $request->id_partido)
          ->update(['validos' => $request->input_voto, 'id_usuario' => Auth::user()->id]);
          } else {
            //Realizamos el registro
            \DB::table('votos_presidenciales')->insert([
              ['id_mesa' => $request->id_mesa,
              'id_partido' => $request->id_partido,
              'validos' => $request->input_voto,
              'id_usuario' => Auth::user()->id]
            ]);
          }
        }
    }

    public function detalle_editar_mesa_r(Request $request){
        if ($request->input_voto_bn == "") { # code...
            return 'sin_valor';
        } else {
          // return \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 1)->get();
          if (count(\DB::table('votos_presidenciales_r')->where('id_mesa', $request->id_mesa)->get()) > 0) {
            if ($request->blanco_nulo == "BLANCO") {
                \DB::table('votos_presidenciales_r')->where('id_mesa', $request->id_mesa)
                ->update(['blancos' => $request->input_voto_bn, 'id_usuario' => Auth::user()->id]);
            } else {
                \DB::table('votos_presidenciales_r')->where('id_mesa', $request->id_mesa)
                ->update(['nulos' => $request->input_voto_bn, 'id_usuario' => Auth::user()->id]);
            }
          } else {
            //Realizamos el registro
            if ($request->blanco_nulo == "BLANCO") {
                \DB::table('votos_presidenciales_r')->insert([
                ['id_mesa' => $request->id_mesa,
                'blancos' => $request->input_voto_bn,
                'nulos' => "",
                'id_usuario' => Auth::user()->id]
                ]);
            } else {
                \DB::table('votos_presidenciales_r')->insert([
                ['id_mesa' => $request->id_mesa,
                'blancos' => "",
                'nulos' => $request->input_voto_bn,
                'id_usuario' => Auth::user()->id]
                ]);
            }
            
          }
        }
    }

    public function detalle_editar_mesa_uninominal(Request $request){
        if ($request->input_voto == "") { # code...
            return 'sin_valor';
        } else {
          // return \DB::table('votos_uninominales')->where('id_mesa', $request->id_mesa)->where('id_partido', 1)->get();
          if (count(\DB::table('votos_uninominales')->where('id_mesa', $request->id_mesa)->where('id_partido', $request->id_partido)->get()) > 0) {
            \DB::table('votos_uninominales')->where('id_mesa', $request->id_mesa)->where('id_partido', $request->id_partido)
          ->update(['validos' => $request->input_voto, 'id_usuario' => Auth::user()->id]);
          } else {
            //Realizamos el registro
            \DB::table('votos_uninominales')->insert([
              ['id_mesa' => $request->id_mesa,
              'id_partido' => $request->id_partido,
              'validos' => $request->input_voto,
              'id_usuario' => Auth::user()->id]
            ]);
          }
        }
    }

    public function detalle_editar_mesa_uninominal_r(Request $request){
        if ($request->input_voto_bn == "") { # code...
            return 'sin_valor';
        } else {
          // return \DB::table('votos_uninominales')->where('id_mesa', $request->id_mesa)->where('id_partido', 1)->get();
          if (count(\DB::table('votos_uninominales_r')->where('id_mesa', $request->id_mesa)->get()) > 0) {
            if ($request->blanco_nulo == "BLANCO") {
                \DB::table('votos_uninominales_r')->where('id_mesa', $request->id_mesa)
                ->update(['blancos' => $request->input_voto_bn, 'id_usuario' => Auth::user()->id]);
            } else {
                \DB::table('votos_uninominales_r')->where('id_mesa', $request->id_mesa)
                ->update(['nulos' => $request->input_voto_bn, 'id_usuario' => Auth::user()->id]);
            }
          } else {
            //Realizamos el registro
            if ($request->blanco_nulo == "BLANCO") {
                \DB::table('votos_uninominales_r')->insert([
                ['id_mesa' => $request->id_mesa,
                'blancos' => $request->input_voto_bn,
                'nulos' => "",
                'id_usuario' => Auth::user()->id]
                ]);
            } else {
                \DB::table('votos_uninominales_r')->insert([
                ['id_mesa' => $request->id_mesa,
                'blancos' => "",
                'nulos' => $request->input_voto_bn,
                'id_usuario' => Auth::user()->id]
                ]);
            }
            
          }
        }
    }

    public function form_asignar_usuario_mesa($id_persona){
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

        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();

        $roles = Role::all();

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

        return view("formularios.form_asignar_usuario_mesa")
        ->with('circunscripciones', $circunscripciones)
        ->with('roles', $roles)
        ->with('casas', $casas)
        ->with('vehiculos', $vehiculos)
        ->with('persona', $persona);
    }

    public function listado_recintos_mesas(){

        return view("listados.listado_recintos_mesas");
    }

    public function detalle_presidenciales_mesa($id_mesa){

        $mesa =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->where('mesas.id_mesa', $id_mesa)
        ->select('recintos.nombre as nombre_recinto', 'mesas.id_mesa', 'recintos.id_recinto', 
        'recintos.circunscripcion', 'recintos.distrito',
        \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
        \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
        'mesas.foto_presidenciales', 'mesas.codigo_ajllita', 'mesas.codigo_mesas_oep'
        )
        ->first();
        
        $partidos = \DB::table('partidos')
        ->orderBy('nivel')
        ->get();

        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
        ->where('mesas.id_mesa', $id_mesa)
        // ->where('partidos.id_partido', 'votos_presidenciales.id_partido')
        ->select('mesas.id_mesa', 'partidos.sigla', 'validos', 'votos_presidenciales.id_partido', 'votos_presidenciales.id_votos_presidenciales',  'partidos.sigla'
        )
        ->orderBy('nivel')
        ->get();

        $detalle_mesas = array();

        foreach ($partidos as $partido) {
            if (count($votos_presidenciales) > 0) {
                foreach ($votos_presidenciales as $vp) {
                    // $e['id_mesa'] = $votos_presidenciales->id_mesa;
                    if (in_array($partido->id_partido, $votos_presidenciales->pluck('id_partido')->toArray())) {
                        if($partido->id_partido == $vp->id_partido) {
                            $e = array();
                            $e['id_votos_presidenciales'] = $vp->id_votos_presidenciales;
                            $e['id_partido'] = $vp->id_partido;
                            $e['sigla'] = $vp->sigla;
                            $e['logo'] = $partido->logo;
                            $e['nombre_partido'] = $partido->nombre;
                            $e['validos'] = $vp->validos;
                            array_push($detalle_mesas, $e);
                        }
                    } else {
                        $e = array();
                        $e['id_votos_presidenciales'] = "";
                        $e['id_partido'] = $partido->id_partido;
                        $e['sigla'] = $partido->sigla;
                        $e['logo'] = $partido->logo;
                        $e['nombre_partido'] = $partido->nombre;
                        $e['validos'] = "";
                        array_push($detalle_mesas, $e);
                        break;
                    }
                }
            }else{
                $e = array();
                $e['id_votos_presidenciales'] = "";
                $e['id_partido'] = $partido->id_partido;
                $e['sigla'] = $partido->sigla;
                $e['logo'] = $partido->logo;
                $e['nombre_partido'] = $partido->nombre;
                $e['validos'] = "";
                array_push($detalle_mesas, $e);
            }
        }

        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->where('mesas.id_mesa', $id_mesa)
        ->select('mesas.id_mesa', 'votos_presidenciales_r.nulos', 'votos_presidenciales_r.blancos', 'votos_presidenciales_r.id_votos_presidenciales_r'
        )
        ->first();

        return view("listados.detalle_presidenciales_mesa")
        ->with('mesa', $mesa)
        ->with('detalle_mesas', $detalle_mesas)
        ->with('votos_presidenciales_r', $votos_presidenciales_r)
        ->with('partidos', $partidos);
    }

    public function detalle_uninominales_mesa($id_mesa){

        $mesa =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->where('mesas.id_mesa', $id_mesa)
        ->select('recintos.nombre as nombre_recinto', 'mesas.id_mesa', 'recintos.id_recinto',
        'recintos.circunscripcion', 'recintos.distrito',
        \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
        \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
        'mesas.foto_uninominales', 'mesas.codigo_ajllita', 'mesas.codigo_mesas_oep'
        )
        ->first();
        
        $partidos = \DB::table('partidos')
        ->orderBy('nivel')
        ->get();

        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->where('mesas.id_mesa', $id_mesa)
        // ->where('partidos.id_partido', 'votos_uninominales.id_partido')
        ->select('mesas.id_mesa', 'partidos.sigla', 'validos', 'votos_uninominales.id_partido', 'partidos.sigla', 'votos_uninominales.id_votos_uninominales'
        )
        ->orderBy('nivel')
        ->get();

        $detalle_mesas = array();

        foreach ($partidos as $partido) {
            if (count($votos_uninominales) > 0) {
                foreach ($votos_uninominales as $vp) {
                    // $e['id_mesa'] = $votos_uninominales->id_mesa;
                    if (in_array($partido->id_partido, $votos_uninominales->pluck('id_partido')->toArray())) {
                        if($partido->id_partido == $vp->id_partido) {
                            $e = array();
                            $e['id_votos_uninominales'] = $vp->id_votos_uninominales;
                            $e['id_partido'] = $vp->id_partido;
                            $e['sigla'] = $vp->sigla;
                            $e['logo'] = $partido->logo;
                            $e['nombre_partido'] = $partido->nombre;
                            $e['validos'] = $vp->validos;
                            array_push($detalle_mesas, $e);
                        }
                    } else {
                        $e = array();
                        $e['id_votos_uninominales'] = "";
                        $e['id_partido'] = $partido->id_partido;
                        $e['sigla'] = $partido->sigla;
                        $e['logo'] = $partido->logo;
                        $e['nombre_partido'] = $partido->nombre;
                        $e['validos'] = "";
                        array_push($detalle_mesas, $e);
                        break;
                    }
                }
            }else{
                $e = array();
                $e['id_votos_uninominales'] = "";
                $e['id_partido'] = $partido->id_partido;
                $e['sigla'] = $partido->sigla;
                $e['logo'] = $partido->logo;
                $e['nombre_partido'] = $partido->nombre;
                $e['validos'] = "";
                array_push($detalle_mesas, $e);
            }
        }

        $votos_uninominales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->where('mesas.id_mesa', $id_mesa)
        ->select('mesas.id_mesa', 'votos_uninominales_r.nulos', 'votos_uninominales_r.blancos', 'votos_uninominales_r.id_votos_uninominales_r'
        )
        ->first();

        return view("listados.detalle_uninominales_mesa")
        ->with('mesa', $mesa)
        ->with('detalle_mesas', $detalle_mesas)
        ->with('votos_uninominales_r', $votos_uninominales_r)
        ->with('partidos', $partidos);
    }

    public function listado_votacion_circunscripcion(){
        $id_persona = Auth::user()->id_persona;
        $id_recinto = \DB::table('personas')
            ->where('personas.id_persona', $id_persona)
            ->pluck('id_recinto')
            ->toArray();
        $recinto = Recinto::find($id_recinto)->first();

        $recintos =\DB::table('recintos')
        ->leftjoin('rel_usuario_distrito', 'recintos.distrito', 'rel_usuario_distrito.id_distrito')
        ->leftjoin('users', 'rel_usuario_distrito.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->where('recintos.circunscripcion', $recinto->circunscripcion)
        // ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.nombre as nombre_recinto', 'recintos.id_recinto', 'recintos.circunscripcion', 'numero_mesas',
                 'recintos.distrito', 
        \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
        \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
        // \DB::raw('SUM(recintos.numero_mesas) as numero_mesas')
        )
        // ->groupBy('recintos.distrito')
        ->orderBy('recintos.distrito')
        ->orderBy('recintos.numero_mesas')
        ->get();

        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
            \DB::raw('count(*) as votos_presidenciales')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

    
        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
        \DB::raw('count(*) as votos_presidenciales_r')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
        \DB::raw('count(*) as votos_uninominales')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

        $votos_uni_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
        \DB::raw('count(*) as votos_uninominales_r')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

        $cantidad_partidos = \DB::table('partidos')
        ->count('id_partido');

        return view("listados.listado_votacion_circunscripcion")
        ->with('recinto', $recinto)
        ->with('recintos', $recintos)
        ->with('votos_presidenciales', $votos_presidenciales)
        ->with('votos_presidenciales_r', $votos_presidenciales_r)
        ->with('votos_uninominales', $votos_uninominales)
        ->with('votos_uni_r', $votos_uni_r)
        ->with('cantidad_partidos', $cantidad_partidos);
    }

    public function listado_votacion_distrito(){
        $id_persona = Auth::user()->id_persona;
        $id_recinto = \DB::table('personas')
            ->where('personas.id_persona', $id_persona)
            ->pluck('id_recinto')
            ->toArray();
        $recinto = Recinto::find($id_recinto)->first();

        $recintos =\DB::table('recintos')
        ->leftjoin('rel_usuario_recinto', 'recintos.id_recinto', 'rel_usuario_recinto.id_recinto')
        ->leftjoin('users', 'rel_usuario_recinto.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.nombre as nombre_recinto', 'recintos.id_recinto', 'recintos.numero_mesas',
        \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
        \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
        )
        ->get();

        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
        \DB::raw('count(*) as votos_presidenciales')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

    
        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
        \DB::raw('count(*) as votos_presidenciales_r')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
        \DB::raw('count(*) as votos_uninominales')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

        $votos_uni_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->where('recintos.distrito', $recinto->distrito)
        ->select('recintos.id_recinto',
        \DB::raw('count(*) as votos_uninominales_r')
        )
        ->groupBy('recintos.id_recinto')
        ->get();

        $cantidad_partidos = \DB::table('partidos')
        ->count('id_partido');

        return view("listados.listado_votacion_distrito")
        ->with('recinto', $recinto)
        ->with('recintos', $recintos)
        ->with('votos_presidenciales', $votos_presidenciales)
        ->with('votos_presidenciales_r', $votos_presidenciales_r)
        ->with('votos_uninominales', $votos_uninominales)
        ->with('votos_uni_r', $votos_uni_r)
        ->with('cantidad_partidos', $cantidad_partidos);
    }


    public function listado_votacion_recinto(){
        $id_persona = Auth::user()->id_persona;
        $id_recinto = \DB::table('personas')
            ->where('personas.id_persona', $id_persona)
            ->pluck('id_recinto')
            ->toArray();
        $recinto = Recinto::find($id_recinto);

        $mesas =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->where('mesas.id_recinto', $id_recinto)
        ->select('recintos.nombre as nombre_recinto',
        'mesas.codigo_mesas_oep',
        'mesas.id_mesa', 'recintos.id_recinto',
        \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
        \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
        )
        ->orderBy('mesas.id_mesa')
        ->get();

        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->where('mesas.id_recinto', $id_recinto)
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_presidenciales')
        )
        ->groupBy('votos_presidenciales.id_mesa')
        ->get();

        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->where('mesas.id_recinto', $id_recinto)
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_presidenciales_r')
        )
        ->groupBy('votos_presidenciales_r.id_mesa')
        ->get();

        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->where('mesas.id_recinto', $id_recinto)
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_uninominales')
        )
        ->groupBy('votos_uninominales.id_mesa')
        ->get();

        $votos_uni_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->where('mesas.id_recinto', $id_recinto)
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_uninominales_r')
        )
        ->groupBy('votos_uninominales_r.id_mesa')
        ->get();

        $cantidad_partidos = \DB::table('partidos')
        ->count('id_partido');

        return view("listados.listado_votacion_recinto")
        ->with('recinto', $recinto)
        ->with('mesas', $mesas)
        ->with('votos_presidenciales', $votos_presidenciales)
        ->with('votos_presidenciales_r', $votos_presidenciales_r)
        ->with('votos_uninominales', $votos_uninominales)
        ->with('votos_uni_r', $votos_uni_r)
        ->with('cantidad_partidos', $cantidad_partidos);
    }

    public function buscar_votacion_recinto(){

        $id_persona = Auth::user()->id_persona;
        $id_recinto = \DB::table('personas')
            ->where('personas.id_persona', $id_persona)
            ->pluck('id_recinto')
            ->toArray();

        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->where('mesas.id_recinto', $id_recinto)
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_presidenciales')
        )
        ->groupBy('votos_presidenciales.id_mesa')
        ->get();

        dd($votos_presidenciales);
        
        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->where('mesas.id_recinto', $id_recinto)
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_presidenciales_r')
        )
        ->groupBy('mesas.id_mesa')
        ->get();
    }

    public function listado_votacion_general(){

        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->select('votos_presidenciales.id_partido',
        \DB::raw('SUM(validos) as validos')
        )
        ->groupBy('votos_presidenciales.id_partido')
        ->get();

        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();

        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->select('votos_uninominales.id_partido',
        \DB::raw('SUM(validos) as validos')
        )
        ->groupBy('votos_uninominales.id_partido')
        ->get();

        $votos_uninominales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();

        $partidos = \DB::table('partidos')->orderBy('nivel')->get();

        return view("listados.listado_votacion_general")
        ->with('votos_presidenciales', $votos_presidenciales)
        ->with('votos_presidenciales_r', $votos_presidenciales_r)
        ->with('votos_uninominales', $votos_uninominales)
        ->with('votos_uninominales_r', $votos_uninominales_r)
        ->with('partidos', $partidos)
        ;
    }

    public function buscar_votacion_general(){
        // $id_persona = Auth::user()->id_persona;
        // $usuario_recinto = \DB::table('users')
        //               ->join('personas', 'personas.id_persona', '=', 'users.id_persona')
        //               ->join('recintos', 'personas.id_recinto', '=', 'recintos.id_recinto')
        //               ->select('recintos.circunscripcion')
        //               ->where('personas.id_persona', $id_persona)
        //               ->first();

        $votos_presidenciales = \DB::table('mesas')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_presidenciales')
        )
        ->groupBy('mesas.id_mesa')
        ->get();
        
        $votos_presidenciales_r = \DB::table('mesas')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('count(*) as votos_presidenciales_r')
        )
        ->groupBy('mesas.id_mesa')
        ->get();


        $votacion =\DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        // ->where('mesas.id_mesa', 624)
        ->get();

        foreach ($votacion as $key => $value) {
            // foreach ($votos_presidenciales as $p) {
            //     if ($value->id_mesa == $p->id_mesa) {
            //         // $votacion[$key] = array_add(get_object_vars($value), 'presidenciales', $p->votos_presidenciales);
            //         $votacion[$key] = array_add(get_object_vars($value), 'presidenciales', [
            //             array(
            //                 'partidos' => '2',
            //                 'nulos_blancos' => '0',)
            //             ]
            //         );
            //     }
            // }
            // foreach ($votos_presidenciales_r as $p_r) {
            //     if ($value[$key]['id_mesa'] == $p_r->id_mesa) {
            //         $votacion[$key] = array_add($value, 'presidenciales_restantes', $p_r->votos_presidenciales_r);
            //     }
            // }
        }
        // foreach ($votacion as $key => $value) {
        //     foreach ($votos_presidenciales_r as $p_r) {
        //         if ($value[$key]['id_mesa'] == $p_r->id_mesa) {
        //             $votacion[$key] = array_add($value, 'presidenciales_restantes', $p_r->votos_presidenciales_r);
        //         }
        //     }
        // }

        // echo "<pre>";
        // print_r($votacion);
        // dd($votacion);
        return Datatables::of($votacion)->make(true); 
    }

    public function listado_distritos_responsables(){

        return view("listados.listado_distritos_responsables");
    }

    public function buscar_distritos_responsables(){
        $id_persona = Auth::user()->id_persona;
        $usuario_recinto = \DB::table('users')
                      ->join('personas', 'personas.id_persona', '=', 'users.id_persona')
                      ->join('recintos', 'personas.id_recinto', '=', 'recintos.id_recinto')
                      ->select('recintos.circunscripcion')
                      ->where('personas.id_persona', $id_persona)
                      ->first();

        $distritos =\DB::table('recintos')       
        // ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        
        ->leftjoin('personas', 'recintos.id_recinto', 'personas.id_recinto')
        ->leftjoin('users', 'personas.id_persona', 'users.id_persona')
        // ->leftjoin('recintos', 'rel_usuario_distrito.id_distrito', 'recintos.distrito')
        // ->where('rel_usuario_mesa.id_usuario', 'users.id')
        // ->whereNotIn('mesas.id_mesa', $mesas_recinto)
        ->where('recintos.circunscripcion', $usuario_recinto->circunscripcion)
        ->select('users.id as id_usuario',
                 'personas.direccion as direccion_persona',
                 \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
                 'recintos.circunscripcion', 'recintos.distrito', 'recintos.nombre as nombre_recinto', 'recintos.zona', 'recintos.direccion as direccion_recinto'
                )
        // ->orderBy('rel_usuario_mesa.activo', 'asc')
        // ->orderBy('mesas.id_mesa', 'asc')
        // ->orderBy('recintos.circunscripcion', 'asc')
        // ->orderBy('recintos.distrito', 'asc')
        ->distinct()
        ->get();
        // dd($distritos);
        return Datatables::of($distritos)->make(true); 
    }
    
    public function buscar_recintos_mesas(){

        $mesas =\DB::table('mesas')       
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->leftjoin('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        // ->where('rel_usuario_mesa.id_usuario', 'users.id')
        // ->whereNotIn('mesas.id_mesa', $mesas_recinto)
        ->select('users.id as id_usuario',
            'rel_usuario_mesa.id_mesa as rel_idmesa', 'rel_usuario_mesa.activo as mesa_activa', 
                 'mesas.id_mesa', 'mesas.id_recinto', 'codigo_mesas_oep', 'mesas.codigo_ajllita',
                 'personas.direccion as direccion_persona',
                 \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
                 'recintos.circunscripcion', 'recintos.distrito', 'recintos.nombre as nombre_recinto', 'recintos.zona', 'recintos.direccion as direccion_recinto'
                )
        // ->orderBy('rel_usuario_mesa.activo', 'asc')
        ->orderBy('mesas.id_mesa', 'asc')
        // ->orderBy('recintos.circunscripcion', 'asc')
        // ->orderBy('recintos.distrito', 'asc')
        ->distinct()
        ->get();
        // dd($mesas);
        return Datatables::of($mesas)->make(true); 
    }

    public function consultaMesasRecinto($id_recinto){

        //Mesas Asignadas
        $mesas =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        // ->where(function($query){
        //     $query
        //     ->where('rel_usuario_mesa.activo', null)
        //     ->orwhere('rel_usuario_mesa.activo', 1);
        // })
        ->where('mesas.id_recinto', $id_recinto)
        // ->whereNotIn('mesas.id_mesa', $mesas_recinto)
        ->select('users.id as id_usuario',
            'rel_usuario_mesa.id_mesa as rel_idmesa', 'rel_usuario_mesa.activo as mesa_activa', 
                 'mesas.id_mesa', 'mesas.id_recinto', 'codigo_mesas_oep', 'codigo_ajllita',
                 'personas.telefono_celular',
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
                 \DB::raw('count(*) as responsables')
                )
        ->orderBy('mesas.id_mesa')
        ->groupBy('mesas.id_mesa')
        ->distinct()
        ->get();

        // $mesas_recinto =\DB::table('rel_usuario_mesa')
        // ->where('rel_usuario_mesa.activo', 1)
        // ->pluck('rel_usuario_mesa.id_mesa')
        // ->toArray();

        // $mesas =\DB::table('mesas')
        // ->where('mesas.id_recinto', $id_recinto)
        // ->whereNotIn('id_mesa', $mesas_recinto)
        // ->select('id_mesa', 'codigo_mesas_oep', 'codigo_ajllita',  'id_recinto')
        // ->get();
        
        return $mesas;
    }

    public function consultaMesasUsuario($id_mesa){

        //Mesas Asignadas al usuario
        $mesas =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->where('mesas.id_mesa', $id_mesa)
        ->select('users.id as id_usuario',
            'rel_usuario_mesa.id_mesa as rel_idmesa', 'rel_usuario_mesa.activo as mesa_activa', 
                 'mesas.id_mesa', 'mesas.id_recinto', 'codigo_mesas_oep', 'codigo_ajllita',
                 'personas.telefono_celular',
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
                )
        ->orderBy('mesas.id_mesa')
        ->distinct()
        ->get();

        return $mesas;
    }

    public function asignar_usuario_mesa(Request $request){
        $persona = Persona::find($request->input("id_persona"));

        $username = $this->ObtieneUsuario($request->input("id_persona"));
        // $persona->id_rol =$request->input("id_rol");

        $usuario = \DB::table('users')
        ->where('id_persona', $request->input("id_persona"))
        ->first();

        if($request->input("rol_slug") == 'militante'){
            //rol delegado del MAS
            return 'militante';
        }elseif ($request->input("rol_slug") == 'conductor') {
            // rol Conductor
            if ($request->input("id_vehiculo") != "") {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);
                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_transporte = new UsuarioTransporte();
                        $usuario_transporte->id_usuario = $usuario->id;
                        $usuario_transporte->id_transporte = $request->input("id_vehiculo");
                        $usuario_transporte->activo = 1;
                        if ($usuario_transporte->save()) {
                            return "ok";
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

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);

                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_casa_campana = new UsuarioCasaCampana();
                        $usuario_casa_campana->id_usuario = $usuario->id;
                        $usuario_casa_campana->id_casa_campana = $request->input("id_casa_campana");
                        $usuario_casa_campana->activo = 1;
                        if ($usuario_casa_campana->save()) {
                            return "ok";
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
                return "id_casa_campana";
            }
            // fin Registrador
        }elseif ($request->input("rol_slug") == 'call_center') {
            //rol 
            return 'call_center';
        }elseif ($request->input("rol_slug") == 'responsable_mesa') {
            //rol responsable_mesa
            if ($request->has("mesas")) {

                $user = false;
                if ($usuario != null) { //El usuario existe
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
    
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
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
                        return "ok";
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
            if ($request->input("recinto") != "" && $request->input("recinto") != 0) {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);

                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_recinto = new UsuarioRecinto;
                        $usuario_recinto->id_usuario = $usuario->id;
                        $usuario_recinto->id_recinto = $request->input("recinto");
                        $usuario_recinto->activo = 1;
                        if ($usuario_recinto->save()) {
                            return "ok";
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
            if ($request->input("distrito") != "" && $request->input("distrito") != 0) {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);
    
                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_distrito = new UsuarioDistrito;
                        $usuario_distrito->id_usuario = $usuario->id;
                        $usuario_distrito->id_distrito = $request->input("distrito");
                        $usuario_distrito->activo = 1;
                        if ($usuario_distrito->save()) {
                            return "ok";
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
            if ($request->input("circunscripcion") != "" && $request->input("circunscripcion") != 0) {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);

                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_circunscripcion = new UsuarioCircunscripcion;
                        $usuario_circunscripcion->id_usuario = $usuario->id;
                        $usuario_circunscripcion->id_circunscripcion = $request->input("circunscripcion");
                        $usuario_circunscripcion->activo = 1;
                        if ($usuario_circunscripcion->save()) {
                            return "ok";
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
        
    }

    public function liberar_responsabilidad(Request $request){

        //Obteniendo los datos de la persona
        $persona = Persona::find($request->input("id_persona"));
        
        // Obteniendo los datos del Usuario segun el id_persona
        $usuario = \DB::table('users')
        ->where('id_persona', $request->input('id_persona'))
        ->first();
        
        $usuario=User::find($usuario->id);

        $rol = \DB::table('roles')
        ->where('roles.id', $persona->id_rol)
        ->first();

        $usuario->revokeRole($rol->id);
        //$usuario->assignRole(15); //Delegado del Mas

        if ($rol->slug == 'militante') {
            # code...
        }elseif ($rol->slug == 'conductor') {
            // Rol Conductor
                $persona->asignado = 0;
                if ($persona->save()) {
                    return 'ok';
                } else {
                    return 'failed_persona';
                }
            // Fin Conductor
        }elseif ($rol->slug == 'registrador') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'call_center') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'responsable_mesa') {
            // Rol responsable_mesa
            if (UsuarioMesa::where('id_usuario', $usuario->id)
            ->update(array('activo' => 0))) {
                // $user = User::find($usuario->id);
                // $user->activo = 0;
                // if ($user->save()) {
                //     return 'ok';
                // } else {
                //     return 'failed_usuario';
                // }
                $persona->asignado = 0;
                if ($persona->save()) {
                    return 'ok';
                } else {
                    return 'failed_persona';
                }
            } else {
                return 'failed_usuario_mesas';
            }
            //Fin responsable_mesa
        }elseif ($rol->slug == 'responsable_recinto') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'responsable_distrito') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'responsable_circunscripcion') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }else {
            return 'failed';
        }

    }

    public function form_ver_recinto(){
        
        $id_persona = Auth::user()->id_persona;
        $persona = Persona::find($id_persona);
        $recinto = Recinto::find($persona->id_recinto);
        $rol = Role::find($persona->id_rol);

        return view("formularios.form_ver_recinto")
        ->with('persona', $persona)
        ->with('recinto', $recinto)
        ->with('rol', $rol);
    }

    public function form_mesas_recinto(){
        return view("formularios.form_mesas_recinto");
    }

    public function asignar_mesas_recinto(){
        $recintos = Recinto::all();
        $mesas = Mesa::all();
        if(count($mesas) == 0){
            $codigo = 0;
            foreach ($recintos as $recinto) {
                $a = 0;
                while ($a < $recinto->numero_mesas) {
                    $codigo++;
                    $a++;
                    $mesa = new Mesa;
                    $mesa->codigo_mesas_oep = $codigo;
                    $mesa->codigo_ajllita = $codigo;
                    $mesa->foto_presidenciales = '';
                    $mesa->foto_uninominales = '';
                    $mesa->numero_votantes = 500; // *** ACTUALIZAR DE ACUERDO AL NUMERO DE VOTANTES POR MESA ***
                    $mesa->id_recinto = $recinto->id_recinto;
                    $mesa->save();
                }
            }
            return "ok";
        }else{
            return "Existen mesas";
        }
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
