<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

use App\User;
use App\Gastronomia;
use App\Visitante;
use App\Conteo;
use App\Literatura;
use App\Turismo;
use App\Productores;
use App\Artesania;
use App\Sexo;
use App\Platos_Tarija;
use App\Medios_Comunicacion;
use App\Medios_Transporte;
use App\Grado_Satisfaccion;

class EncuestasController extends Controller
{
    public function truncate(){
        if(\Auth::user()->isRole('super_admin')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        \DB::table('conteo')->truncate();
        \DB::table('artesania')->truncate();
        \DB::table('gastronomia')->truncate();
        \DB::table('literatura')->truncate();
        \DB::table('productores')->truncate();
        \DB::table('turismo')->truncate();
        \DB::table('visitantes')->truncate();
        // $usuarios = \DB::table('users')
        // ->join('role_user', 'users.id', 'role_user.user_id')
        // ->where('role_id', 8)->get();

        // dd($usuarios);

        // foreach ($usuarios as $usuario) {
        //     $user=User::find($usuario->user_id);
        //     $user->revokeRole($usuario->role_id);//quitando roles
        //     $user->assignRole(6); //asignando rol estandar
        // }
        return "ok";
    }

    public function limpiar_registros(){
        if(\Auth::user()->isRole('super_admin')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        return view('listados.limpiar_registros');
    }

    public function habilitar_encuesta(){

        $usuarios = \DB::table('users')
        ->join('role_user', 'users.id', 'role_user.user_id')
        ->where('role_id', 8)->get();
        // dd($usuarios);

        foreach ($usuarios as $usuario) {
            $user=User::find($usuario->user_id);
            $user->revokeRole($usuario->role_id);//quitando roles
            $user->assignRole(6); //asignando rol estandar
        }
        return "ok";
    }

    public function inhabilitar_encuesta(){

        $usuarios = \DB::table('users')
        ->join('role_user', 'users.id', 'role_user.user_id')
        ->where('role_id', 6)->get();
        // dd($usuarios);

        foreach ($usuarios as $usuario) {
            $user=User::find($usuario->user_id);
            $user->revokeRole($usuario->role_id);//quitando roles
            $user->assignRole(8); //asignando rol estandar
        }
        return "ok";
    }

    public function form_conteo(){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        return view("formularios.form_conteo");
    }

    public function form_conteo_mujeres(){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        return view("formularios.form_conteo_mujeres");
    }

    public function enviar_tres_m(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $conteo = new Conteo;
        $conteo->numero = $request->input("numero");
        $conteo->sexo = "F";

        if($conteo->save()){
            return "ok";
        }
        else{
            return "failed";
        }
    }

    public function enviar_cinco_m(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $conteo = new Conteo;
        $conteo->numero = $request->input("numero");
        $conteo->sexo = "F";

        if($conteo->save()){
            return "ok";
        }
        else{
            return "failed";
        }
    }
    public function enviar_diez_m(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $conteo = new Conteo;
        $conteo->numero = $request->input("numero");
        $conteo->sexo = "F";

        if($conteo->save()){
            return "ok";
        }
        else{
            return "failed";
        }
    }

    public function enviar_tres_v(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $conteo = new Conteo;
        $conteo->numero = $request->input("numero");
        $conteo->sexo = "M";

        if($conteo->save()){
            return "ok";
        }
        else{
            return "failed";
        }
    }

    public function enviar_cinco_v(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $conteo = new Conteo;
        $conteo->numero = $request->input("numero");
        $conteo->sexo = "M";

        if($conteo->save()){
            return "ok";
        }
        else{
            return "failed";
        }
    }
    public function enviar_diez_v(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $conteo = new Conteo;
        $conteo->numero = $request->input("numero");
        $conteo->sexo = "M";

        if($conteo->save()){
            return "ok";
        }
        else{
            return "failed";
        }
    }

    public function form_encuesta_gastronomia(){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        $platos_tarija = Platos_Tarija::all();
        return view("formularios.form_encuesta_gastronomia")
        ->with('platos_tarija', $platos_tarija);
    }

    public function enviar_gastronomia(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $gastronomia = new Gastronomia;
        $gastronomia->plato = $request->input("plato_preparado");
        $gastronomia->preparados = $request->input("platos_preparados");
        $gastronomia->vendidos = $request->input("platos_vendidos");
        $gastronomia->costo = $request->input("platos_costo");
        $gastronomia->ingreso_gastronomia = $request->input("platos_ingreso");

        if($gastronomia->save()){
            return view("mensajes.msj_enviado")->with("msj","enviado_gastronomia");
        }else{
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al enviar formulario ;...");
        }
    }

    public function reporte_gastronomia(){
        $total = Conteo::select(\DB::raw('SUM(numero) as total'))->first();
        return view("listados.reporte_gastronomia")
        ->with('total', $total);
    }
    public function reporte_plato_genero(){
        return view("listados.reporte_gastronomia");
    }

    public function plato_mas_vendido(){
        $gastronomia = Gastronomia::select(\DB::raw('gastronomia.*, SUM(vendidos) as vendidos'))
        // ->leftJoin('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
        // ->where('gestiones.id_usuario', $user_id)
       //  ->where('gestiones.id', '=', 'usadas.id_gestion')
        ->groupBy('plato')
        ->orderBy('vendidos')
        ->get();

        $total = Gastronomia::select(\DB::raw('SUM(vendidos) as total'))->first();

        $data = array();

        foreach ($gastronomia as $gastro) {
            $d = array();
            $d['value'] = round(($gastro->vendidos * 100)/$total['total']);
            $d['color'] = '#f39c12';
            $d['highlight'] = '#f39c12';
            $d['label'] = $gastro->plato;
            array_push($data, $d);
        }

        $data = json_encode($data);
        return  $data;
    }
    public function asistencia(){
        $gastronomia = Conteo::select(\DB::raw('conteo.*, SUM(numero) as suma'))
        // ->leftJoin('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
        // ->where('gestiones.id_usuario', $user_id)
       //  ->where('gestiones.id', '=', 'usadas.id_gestion')
        ->groupBy('sexo')
        ->get();

        $total = Conteo::select(\DB::raw('SUM(numero) as total'))->first();

        $data = array();

        foreach ($gastronomia as $gastro) {
            $d = array();
            // $d['value'] = round(($gastro->suma * 100)/$total['total']);
            $d['value'] = round(($gastro->suma * 100)/$total['total']);
            $d['color'] = '#f39c12';
            $d['highlight'] = '#f39c12';
            if($gastro->sexo == "M"){
                $d['label'] = "Varones";
            }
            if($gastro->sexo == "F"){
                $d['label'] = "Mujeres";
            }

            
            array_push($data, $d);
        }

        $data = json_encode($data);
        return  $data;
    }

    public function plato_favorito(){
        $gastronomia = Gastronomia::select(\DB::raw('gastronomia.*, SUM(preparados) as preparados'))
        // ->leftJoin('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
        // ->where('gestiones.id_usuario', $user_id)
       //  ->where('gestiones.id', '=', 'usadas.id_gestion')
        ->groupBy('plato')
        ->get();

        $data = array();

        foreach ($gastronomia as $gastro) {
            $d = array();
            $d['value'] = $gastro->preparados;
            $d['color'] = '#f39c12';
            $d['highlight'] = '#f39c12';
            $d['label'] = $gastro->plato;
            array_push($data, $d);
        }

        $data = json_encode($data);
        return  $data;
    }

    public function plato_genero(){
        $plato_m = Visitante::select(\DB::raw('visitantes.*, COUNT(plato_preferido) as plato'))
        // ->leftJoin('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
        ->where('sexo', "F")
       //  ->where('gestiones.id', '=', 'usadas.id_gestion')
        
        ->groupBy('plato_preferido')
        // ->groupBy('plato_preferido')
        ->orderBy('plato', 'desc')
        ->get();
        $plato_v = Visitante::select(\DB::raw('visitantes.*, COUNT(plato_preferido) as plato'))
        // ->leftJoin('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
        ->where('sexo', "M")
       //  ->where('gestiones.id', '=', 'usadas.id_gestion')
        
        ->groupBy('plato_preferido')
        // ->groupBy('plato_preferido')
        ->orderBy('plato', 'desc')
        ->get();

        $data = array();


            $d = array();
            $d['value'] = $plato_m[0]->plato_preferido;
            $d['color'] = '#f39c12';
            $d['highlight'] = '#f39c12';
            $d['label'] = $plato_m[0]->sexo;
            array_push($data, $d);

            $d = array();
            $d['value'] = $plato_v[0]->plato_preferido;
            $d['color'] = '#f39c12';
            $d['highlight'] = '#f39c12';
            $d['label'] = $plato_v[0]->sexo;
            array_push($data, $d);


        $data = json_encode($data);
        return  $data;
    }

    
    public function form_encuesta_visitante(){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        $platos_tarija = Platos_Tarija::all();
        return view("formularios.form_encuesta_visitante")
        ->with('platos_tarija', $platos_tarija);
    }

    public function reporte_final(){    
        return view("listados.reporte_final");
    }

    public function enviar_visitante(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $visitante = new Visitante;
        // $visitante->nombre = $request->input("nombre");
        $visitante->sexo = $request->input("sexo");
        $visitante->medio_comunicacion = $request->input("medio_comunicacion");
        $visitante->medio_transporte = $request->input("medio_transporte");
        $visitante->grado_satisfaccion = $request->input("grado_satisfaccion");
        $visitante->plato_preferido = $request->input("plato_preferido");

        if($visitante->save()){
            return view("mensajes.msj_enviado")->with("msj","enviado_visitante");
        }else{
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al enviar formulario ;...");
        }

    }

    public function form_encuesta_literatura(){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        return view("formularios.form_encuesta_literatura");
    }

    public function enviar_literatura(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $literatura = new Literatura;
        // $literatura->libros_a_vender = $request->input("libros_a_vender");
        // $literatura->libros_vendidos = $request->input("libros_vendidos");
        $literatura->libro_mas_vendido = $request->input("libro_mas_vendido");
        $literatura->ingreso_literatura = $request->input("ingreso_literatura");

        if($literatura->save()){
            return view("mensajes.msj_enviado")->with("msj","enviado_literatura");
        }else{
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al enviar formulario ...");
        }
    }

    public function form_encuesta_turismo(){    
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        return view("formularios.form_encuesta_turismo");
    }

    public function enviar_turismo(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $turismo = new Turismo;
        $turismo->lugar = $request->input("lugar");
        $turismo->venta_paquete = $request->input("venta_paquete");
        $turismo->ingreso_turismo = $request->input("ingreso_turismo");

        if($turismo->save()){
            return view("mensajes.msj_enviado")->with("msj","enviado_turismo");
        }else{
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al enviar formulario ;...");
        }
    }

    public function form_encuesta_productores(){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }
        return view("formularios.form_encuesta_productores");
    }

    public function enviar_productores(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $productores = new Productores;
        $productores->ingreso_productores = $request->input("ingreso_productores");

        if($productores->save()){
            return view("mensajes.msj_enviado")->with("msj","enviado_productores");
        }else{
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al enviar formulario ;...");
        }
    }

    public function form_encuesta_artesania(){  
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",'<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Alto !<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Sistema de encuestas cerrado </label>   </div></div> ') ;
        }  
        return view("formularios.form_encuesta_artesania");
    }

    public function enviar_artesania(Request $request){
        if(\Auth::user()->isRole('encuestador')==false){
            return view("mensajes.mensaje_error")->with("msj",' Sistema de encuestas cerrado ') ;
        }
        $productores = new Artesania;
        $productores->ingreso_artesania = $request->input("ingreso_artesania");

        if($productores->save()){
            return view("mensajes.msj_enviado")->with("msj","enviado_artesania");
        }else{
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al enviar formulario ;...");
        }
    }

    public function reporte_encuesta(){
        $sexos = Sexo::all();
        $visitantes = Visitante::all();
        $platos_tarija = Platos_Tarija::all();
        $medios_comunicacion = Medios_Comunicacion::all();
        $medios_transporte = Medios_Transporte::all();
        $grado_satisfaccion = Grado_Satisfaccion::all();
        return view("listados.reporte_encuesta")
        ->with('grado_satisfaccion', $grado_satisfaccion)
        ->with('medios_transporte', $medios_transporte)
        ->with('medios_comunicacion', $medios_comunicacion)
        ->with('platos_tarija', $platos_tarija)
        ->with('sexos', $sexos)
        ->with('visitantes', $visitantes);
    }

    public function reporte_encuesta_gastronomia(){
        $sexos = Sexo::all();
        $visitantes = Gastronomia::all();
        $platos_tarija = Platos_Tarija::all();
        $medios_comunicacion = Medios_Comunicacion::all();
        $medios_transporte = Medios_Transporte::all();
        $grado_satisfaccion = Grado_Satisfaccion::all();
        return view("listados.reporte_encuesta_gastronomia")
        ->with('grado_satisfaccion', $grado_satisfaccion)
        ->with('medios_transporte', $medios_transporte)
        ->with('medios_comunicacion', $medios_comunicacion)
        ->with('platos_tarija', $platos_tarija)
        ->with('sexos', $sexos)
        ->with('visitantes', $visitantes);
    }

    public function reporte_encuesta_literatura(){
        $literatura = Literatura::all();

        return view("listados.reporte_encuesta_literatura")
        ->with('literatura', $literatura);
    }
    public function reporte_encuesta_turismo(){
        $turismo = Turismo::all();

        return view("listados.reporte_encuesta_turismo")
        ->with('turismo', $turismo);
    }
    public function reporte_encuesta_productores(){
        $productores = Productores::all();

        return view("listados.reporte_encuesta_productores")
        ->with('productores', $productores);
    }
    public function reporte_encuesta_artesania(){
        $artesania = Artesania::all();

        return view("listados.reporte_encuesta_artesania")
        ->with('artesania', $artesania);
    }

}
