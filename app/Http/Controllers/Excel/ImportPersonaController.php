<?php

namespace App\Http\Controllers\Excel;

use App\User;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ImportPersonaController extends Controller
{
    function index()
    {
        // $data = User::orderBy('id', 'desc')->get();
        $data = Persona::with('usuario')->with('roles_persona')->get();
        return view('excel.persona.index', compact('data'));
    }

    function import(Request $request)
    {
        if($request->hasFile('select_file')){
            $path = $request->file('select_file')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();

            $cedula = $data->pluck('cedula')->toArray();
            if( count($cedula) != count(array_unique($cedula)) ){
                return back()->with('mensaje_error','Las cédulas de Identidad no deben estar repetidas.');
            }

            $insert_persona = array();
            $insert_usuario = array();
            $last_id = Persona::all();

            if (count($last_id)) {
                $last_id = $last_id->last()->id_persona;
            } else {
                $last_id = 0;
            }
            
            foreach ($data->toArray() as $key => $value) {

                $reglas=[
                    'nombre'  => 'required',
                    'paterno' => 'required_without:materno',
                    'materno' => 'required_without:paterno',
                    'cedula'  => 'required|unique:personas,cedula_identidad'
                    ];
                    
                $mensajes=[
                    'nombre.required' => 'El campo nombre es obligatorio.',
                    'cedula.unique' => 'Una o más cédulas ya esta registradas en el Sistema.',
                ];
        
                $validator = Validator::make( $value,$reglas,$mensajes );
                if( $validator->fails() ){ 
                    $persona = User::with('persona')->get();
                    return back()->with('mensaje_error','Revise los siguientes Datos.')
                  ->withErrors($validator)
                  ->withInput($request->flash());
                }

                $id = $last_id++;

                $u = array();

                $u['name'] = $value['cedula'];
                $u['email'] = $value['cedula'];
                $u['password'] = bcrypt($value['cedula']);
                $u['id_persona'] = $id;
                array_push($insert_usuario, $u);

                $p = array();
                $u['id_persona'] = $id;
                $p['nombre'] = ucwords($value['nombre']);
                $p['paterno'] = ucwords($value['paterno']);
                $p['materno'] = ucwords($value['materno']);
                $p['cedula_identidad'] = $value['cedula'];
                $p['complemento_cedula'] = $value['comp_ci'];
                $p['expedido'] = $value['exp'];
                $p['fecha_nacimiento'] = $value['fecha_nac'];
                $p['telefono_celular'] = $value['celular'];
                $p['telefono_referencia'] = $value['telf_ref'];
                $p['email'] = $value['email'];
                $p['direccion'] = $value['direccion'];
                $p['grado_compromiso'] = $value['grado_comp'];
                $p['fecha_registro'] = date('Y-m-d');
                $p['activo'] = 1;
                $p['asignado'] = 1;
                $p['id_recinto'] = $value['id_recinto'];
                $p['id_origen'] = $value['id_origen'];
                $p['id_sub_origen'] = $value['id_sub_origen'];
                $p['id_responsable_registro'] = Auth::id();
                $p['id_rol'] = $value['id_rol'];
                $p['titularidad'] = $value['titularidad'];
                $p['informatico'] = $value['informatico'];
                $p['militancia'] = $value['militancia'];
                array_push($insert_persona, $p);
            }
            // return $insert_persona;
            if(!empty($insert_persona)){
                Persona::insert($insert_persona);

                if(!empty($insert_usuario)){
                    User::insert($insert_usuario);
                    return back()->with('mensaje_exito','Insert Record successfully.');
                }
            }


        }

    }
}
