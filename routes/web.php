<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
    return redirect('/login');
});

//REDIRECCIONA AL FORMULARIO DE CONSULTA DESDE UN INICIO

// Route::get('/', function () {
//     return redirect('form_consulta');
// });

Route::get('form_consulta', 'ConsultasController@form_consulta');
Route::get('consultaMesaAsignada/{recinto}', 'ConsultasController@consultaMesaAsignada');

Route::get('delegados_mesa', 'ExcelController@delegados_mesa');
Route::get('test_page', 'ExcelController@test_page');

Route::get('form_pruebas', 'PruebasController@form_pruebas');
Route::get('log_conexiones', 'PruebasController@log_conexiones');

Auth::routes();

Route::group(["middleware" => "apikey.validate"], function () {

    //Rutas
    // Route::get("cursos", "Api\CursoController@getCursos");
    Route::get('indexAPI', 'ServiciosController@indexAPI');
    Route::get('getResultados', 'ServiciosController@getResultados');


    //Graficas JSON
    // Route::get('presidenciales', 'GraficosController@presidenciales');

  });

Route::group(['middleware' => 'cors'], function () {
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/listado_personas', function (){
        return view('listado.listado_personas');
    })->name('admin.listado_personas'); // <--- este es el nombre que busca el controlador.
    
    Route::get('/home', 'HomeController@index');

    Route::get('form_asignacion_delegado_excel', 'ExcelController@form_asignacion_delegado_excel');

    Route::get('form_agregar_persona', 'PersonasController@form_agregar_persona');


    Route::get('form_vista_recintos', 'VistasController@form_vista_recintos');
    

    Route::get('form_agregar_transporte', 'TransportesController@form_agregar_transporte');
    Route::post('agregar_transporte', 'TransportesController@agregar_transporte');
    Route::get('consultaSuborigen/{id_suborigen}', 'TransportesController@consultaSuborigen');
    //
    Route::get('revisar_transportes', 'TransportesController@revisar_transportes');
    //
    Route::get('listado_transportes', 'TransportesController@listado_transportes');
    Route::post('buscar_transportes', 'TransportesController@buscar_transportes');
    Route::get('revisar_transportes_asistencia', 'TransportesController@revisar_transportes_asistencia');

    Route::get('form_agregar_persona', 'PersonasController@form_agregar_persona');
    Route::post('agregar_persona', 'PersonasController@agregar_persona');

    Route::get('form_editar_persona/{id_persona}', 'PersonasController@form_editar_persona');
    Route::post('editar_persona', 'PersonasController@editar_persona');
    Route::post('editar_asignacion_persona', 'PersonasController@editar_asignacion_persona');
    Route::post('editar_evidencia_persona', 'PersonasController@editar_evidencia_persona');

    Route::get('form_baja_persona/{id_persona}', 'PersonasController@form_baja_persona');

    Route::get('listado_personas', 'PersonasController@listado_personas');
    Route::resource('buscar_persona', 'PersonasController@buscar_persona');

    Route::post('baja_persona', 'PersonasController@baja_persona');

    Route::get('listado_personas_asignacion', 'PersonasController@listado_personas_asignacion');
    Route::resource('buscar_persona_asignacion', 'PersonasController@buscar_persona_asignacion');

    Route::post('detalle_editar_mesa', 'MesasController@detalle_editar_mesa');
    Route::post('detalle_editar_mesa_r', 'MesasController@detalle_editar_mesa_r');
    Route::post('detalle_editar_mesa_uninominal', 'MesasController@detalle_editar_mesa_uninominal');
    Route::post('detalle_editar_mesa_uninominal_r', 'MesasController@detalle_editar_mesa_uninominal_r');

    Route::get('form_mesas_recinto', 'MesasController@form_mesas_recinto');
    Route::post('asignar_mesas_recinto', 'MesasController@asignar_mesas_recinto');

    Route::get('detalle_presidenciales_mesa/{id_mesa}', 'MesasController@detalle_presidenciales_mesa');
    Route::get('detalle_uninominales_mesa/{id_mesa}', 'MesasController@detalle_uninominales_mesa');

    Route::get('listado_recintos_mesas', 'MesasController@listado_recintos_mesas');
    Route::resource('buscar_recintos_mesas', 'MesasController@buscar_recintos_mesas');

    Route::get('listado_distritos_responsables', 'MesasController@listado_distritos_responsables');
    Route::resource('buscar_distritos_responsables', 'MesasController@buscar_distritos_responsables');

    Route::get('listado_votacion_general', 'MesasController@listado_votacion_general');
    Route::resource('buscar_votacion_general', 'MesasController@buscar_votacion_general');

    Route::get('listado_votacion_recinto', 'MesasController@listado_votacion_recinto');
    Route::resource('buscar_votacion_recinto', 'MesasController@buscar_votacion_recinto');

    Route::get('listado_votacion_distrito', 'MesasController@listado_votacion_distrito');
    Route::resource('buscar_votacion_distrito', 'MesasController@buscar_votacion_distrito');

    Route::get('listado_votacion_circunscripcion', 'MesasController@listado_votacion_circunscripcion');
    Route::resource('buscar_votacion_circunscripcion', 'MesasController@buscar_votacion_circunscripcion');

    Route::get('votacion_general', 'GraficosController@votacion_general');
    Route::get('porcentaje_votacion_general', 'GraficosController@porcentaje_votacion_general');

    Route::get('presidenciales', 'GraficosController@presidenciales');
    Route::get('porcentaje_presidenciales', 'GraficosController@porcentaje_presidenciales');
    Route::get('form_resumen_global_por_distrito', 'GraficosController@form_resumen_global_por_distrito');

    Route::get('votacion_general_uninominales', 'GraficosController@votacion_general_uninominales');
    Route::get('uninominales_c10', 'GraficosController@uninominales_c10');
    Route::get('uninominales_c11', 'GraficosController@uninominales_c11');
    Route::get('uninominales_c12', 'GraficosController@uninominales_c12');
    Route::get('uninominales_c13', 'GraficosController@uninominales_c13');


    Route::get('form_asignar_usuario_mesa/{id_persona}', 'MesasController@form_asignar_usuario_mesa');
    Route::post('asignar_usuario_mesa', 'MesasController@asignar_usuario_mesa');
    Route::post('liberar_responsabilidad', 'MesasController@liberar_responsabilidad');

    Route::get('form_ver_recinto', 'MesasController@form_ver_recinto');

    // Route::get('ObtieneUsuarioMd5/{id_circ}/{id_distrito}/{id_recinto}', 'UsuariosController@ObtieneUsuarioMd5');
    Route::get('ObtieneUsuario/{id_persona}/', 'UsuariosController@ObtieneUsuario');

    Route::get('agregar_usuario', 'UsuariosController@agregar_usuario');
    Route::get('consultaUsuarioRegistrado/{recinto}', 'PersonasController@consultaUsuarioRegistrado');
    
    Route::get('consultaDistritos/{id_circunscripcion}', 'RecintosController@consultaDistritos');
    Route::get('consultaRecintos/{id_distrito}/{id_circunscripcion}', 'RecintosController@consultaRecintos');
    Route::get('consultaRecintosPorRecinto/{recinto}', 'RecintosController@consultaRecintosPorRecinto');
    Route::get('consultaSubOrigen/{id_origen}', 'PersonasController@consultaSubOrigen');
    Route::get('consultaMesasRecinto/{id_recinto}', 'MesasController@consultaMesasRecinto');
    Route::get('consultaMesasUsuario/{id_mesa}', 'MesasController@consultaMesasUsuario');
    Route::get('listado_recintos_data/{circ}', 'RecintosController@listado_recintos_data');

    Route::post('registrar_falta', 'AsistenciasController@registrar_falta');
    Route::get('form_agregar_lista_de_asistencia', 'AsistenciasController@form_agregar_lista_de_asistencia');
    Route::post('agregar_lista_de_asistencia', 'AsistenciasController@agregar_lista_de_asistencia');
    Route::get('form_listas_de_asistencia', 'AsistenciasController@form_listas_de_asistencia');
    Route::post('lista_de_asistencia_recinto', 'AsistenciasController@lista_de_asistencia_recinto');
    Route::post('lista_de_asistencia_recinto_buscar', 'AsistenciasController@lista_de_asistencia_recinto_buscar');
    Route::post('lista_de_asistencia', 'AsistenciasController@lista_de_asistencia');
    Route::post('lista_de_asistencia_buscar', 'AsistenciasController@lista_de_asistencia_buscar');
    Route::get('form_registrar_asistencia', 'AsistenciasController@form_registrar_asistencia');
    Route::post('registrar_asistencia', 'AsistenciasController@registrar_asistencia');
    Route::post('registrar_falta', 'AsistenciasController@registrar_falta');

    //Votaciones
    Route::post('llenado_emergencia', 'VotacionesController@llenado_emergencia');
    Route::post('llenado_emergencia_uninominales', 'VotacionesController@llenado_emergencia_uninominales');
    Route::get('form_llenar_mesas_emergencia_tipo', 'VotacionesController@form_llenar_mesas_emergencia_tipo');

    Route::get('form_llenado_emergencia/{id_recinto}', 'VotacionesController@form_llenado_emergencia');
    Route::get('form_llenado_emergencia_uninominales/{id_recinto}', 'VotacionesController@form_llenado_emergencia_uninominales');


    Route::get('form_votar_seleccionar_mesa', 'VotacionesController@form_votar_seleccionar_mesa');
    Route::post('form_votar_seleccionar_tipo', 'VotacionesController@form_votar_seleccionar_tipo');
    Route::post('form_votar_presidencial', 'VotacionesController@form_votar_presidencial');
    Route::post('form_votar_presidencial_partido', 'VotacionesController@form_votar_presidencial_partido');
    Route::post('votar_presidencial_partido', 'VotacionesController@votar_presidencial_partido');
    Route::post('form_votar_presidencial_nyb', 'VotacionesController@form_votar_presidencial_nyb');
    Route::post('votar_presidencial_nyb', 'VotacionesController@votar_presidencial_nyb');
    Route::post('form_votar_presidencial_subir_imagen', 'VotacionesController@form_votar_presidencial_subir_imagen');
    Route::get('form_votar_presidencial_subir_imagen_popup/{id_mesa}', 'VotacionesController@form_votar_presidencial_subir_imagen_popup');
    Route::post('votar_presidencial_subir_imagen', 'VotacionesController@votar_presidencial_subir_imagen');
    Route::post('form_votar_uninominal', 'VotacionesController@form_votar_uninominal');
    Route::post('form_votar_uninominal_partido', 'VotacionesController@form_votar_uninominal_partido');
    Route::post('votar_uninominal_partido', 'VotacionesController@votar_uninominal_partido');
    Route::post('form_votar_uninominal_nyb', 'VotacionesController@form_votar_uninominal_nyb');
    Route::post('votar_uninominal_nyb', 'VotacionesController@votar_uninominal_nyb');
    Route::post('form_votar_uninominal_subir_imagen', 'VotacionesController@form_votar_uninominal_subir_imagen');
    Route::get('form_votar_uninominal_subir_imagen_popup/{id_mesa}', 'VotacionesController@form_votar_uninominal_subir_imagen_popup');
    Route::post('votar_uninominal_subir_imagen', 'VotacionesController@votar_uninominal_subir_imagen');
    









    Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');
    Route::post('crear_usuario', 'UsuariosController@crear_usuario');
    Route::post('editar_usuario', 'UsuariosController@editar_usuario');
    Route::post('buscar_usuario', 'UsuariosController@buscar_usuario');
    Route::post('borrar_usuario', 'UsuariosController@borrar_usuario');
    Route::post('editar_acceso', 'UsuariosController@editar_acceso');


    Route::post('crear_rol', 'UsuariosController@crear_rol');
    Route::post('crear_permiso', 'UsuariosController@crear_permiso');
    Route::post('asignar_permiso', 'UsuariosController@asignar_permiso');
    Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso');

    Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
    Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol');
    Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso');
    Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario');
    Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario');
    Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol');
    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol');
    Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario');
    Route::get('borrar_rol/{idrol}', 'UsuariosController@borrar_rol');

    //ENCUESTAS
    Route::get('form_conteo', 'EncuestasController@form_conteo');
    Route::get('form_conteo_mujeres', 'EncuestasController@form_conteo_mujeres');
    Route::post('enviar_tres_v', 'EncuestasController@enviar_tres_v');
    Route::post('enviar_cinco_v', 'EncuestasController@enviar_cinco_v');
    Route::post('enviar_diez_v', 'EncuestasController@enviar_diez_v');
    Route::post('enviar_tres_m', 'EncuestasController@enviar_tres_m');
    Route::post('enviar_cinco_m', 'EncuestasController@enviar_cinco_m');
    Route::post('enviar_diez_m', 'EncuestasController@enviar_diez_m');

    Route::post('habilitar_encuesta', 'EncuestasController@habilitar_encuesta');
    Route::post('inhabilitar_encuesta', 'EncuestasController@inhabilitar_encuesta');
    Route::get('limpiar_registros/', 'EncuestasController@limpiar_registros');
    Route::post('truncate', 'EncuestasController@truncate');

    Route::get('form_encuesta_gastronomia', 'EncuestasController@form_encuesta_gastronomia');
    Route::post('enviar_gastronomia', 'EncuestasController@enviar_gastronomia');
    Route::get('reporte_gastronomia', 'EncuestasController@reporte_gastronomia');
    Route::get('plato_favorito', 'EncuestasController@plato_favorito');
    Route::get('plato_mas_vendido', 'EncuestasController@plato_mas_vendido');
    Route::get('reporte_plato_genero', 'EncuestasController@reporte_plato_genero');
    Route::get('plato_genero', 'EncuestasController@plato_genero');
    // Route::get('asistencia', 'EncuestasController@asistencia');
    Route::get('reporte_final', 'EncuestasController@reporte_final');


    Route::get('form_encuesta_visitante', 'EncuestasController@form_encuesta_visitante');
    Route::post('enviar_visitante', 'EncuestasController@enviar_visitante');

    Route::get('form_encuesta_literatura', 'EncuestasController@form_encuesta_literatura');
    Route::post('enviar_literatura', 'EncuestasController@enviar_literatura');

    Route::get('form_encuesta_turismo', 'EncuestasController@form_encuesta_turismo');
    Route::post('enviar_turismo', 'EncuestasController@enviar_turismo');

    Route::get('form_encuesta_productores', 'EncuestasController@form_encuesta_productores');
    Route::post('enviar_productores', 'EncuestasController@enviar_productores');

    Route::get('form_encuesta_artesania', 'EncuestasController@form_encuesta_artesania');
    Route::post('enviar_artesania', 'EncuestasController@enviar_artesania');

    Route::get('reporte_encuesta', 'EncuestasController@reporte_encuesta');
    Route::get('reporte_encuesta_gastronomia', 'EncuestasController@reporte_encuesta_gastronomia');
    Route::get('reporte_encuesta_literatura', 'EncuestasController@reporte_encuesta_literatura');
    Route::get('reporte_encuesta_turismo', 'EncuestasController@reporte_encuesta_turismo');
    Route::get('reporte_encuesta_productores', 'EncuestasController@reporte_encuesta_productores');
    Route::get('reporte_encuesta_artesania', 'EncuestasController@reporte_encuesta_artesania');

    //directorio
    Route::get('form_nuevo_contacto', 'DirectorioController@form_nuevo_contacto');
    Route::get('form_editar_contacto/{id}', 'DirectorioController@form_editar_contacto');
    Route::post('crear_contacto', 'DirectorioController@crear_contacto');
    Route::post('editar_contacto', 'DirectorioController@editar_contacto');

    // Route::post('buscar_persona', 'DirectorioController@buscar_persona');
    // Route::get('listado_personas/{filtro?}/{orden?}', 'DirectorioController@listado_personas');
    // Route::any('buscar_persona', 'DirectorioController@buscar_persona');

    Route::resource('listado_empresas', 'DirectorioController@listado_empresas');
    Route::resource('listado_empresas_data', 'DirectorioController@data_empresas');

    //Direcciones
    Route::get('/form_info_direcciones', 'VacacionController@form_info_direcciones');
    Route::get('consultaDirecciones/{id}', 'DireccionController@consultaDirecciones');

    //Unidades
    Route::get('consultaUnidades/{id}', 'UnidadesController@consultaUnidades');


    //Usuarios
    Route::get('form_agregar_usuario', 'UsuariosController@form_agregar_usuario');
    Route::get('reporte_usuarios', 'UsuariosController@reporte_usuarios');

    //Calendario
    Route::get('form_calendar', 'CalendarioController@form_calendar');
    Route::get('calendar_datos', 'CalendarioController@calendar_datos');
    Route::get('estado_calendario/{id_sol}', 'CalendarioController@estado_calendario');
    Route::get('calendar_datos_suspension/{id}', 'CalendarioController@calendar_datos_suspension');
    Route::get('calendar_datos_emergencias/{id}', 'CalendarioController@calendar_datos_emergencias');


});
