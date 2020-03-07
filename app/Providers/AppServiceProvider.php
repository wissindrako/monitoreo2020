<?php

namespace App\Providers;

use App\Persona;
use Illuminate\Support\ServiceProvider;
use Auth;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
        if (Auth::guest()) {
            $personas_logueadas = [];
            $control_mesas_votacion = [];
        } else {

            // $personas_logueadas = \DB::table('users')
            // ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
            // ->leftjoin('recintos', 'personas.id_recinto', 'recintos.id_recinto')
            // ->where('users.id', Auth::user()->id)
            // ->select('users.id as id_usuario', 'users.name', 'recintos.id_recinto',
            // 'personas.telefono_celular', 'personas.nombre', 'personas.paterno', 'personas.materno',
            // \DB::raw('CONCAT(personas.cedula_identidad,personas.complemento_cedula) as ci'),
            // \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
            // )
            // ->first();

            $personas_logueadas = User::find(Auth::user()->id)->persona()->first();

            // $control_mesas_votacion = \DB::table('votos_presidenciales')
            // ->select(
            //     'votos_presidenciales.id_mesa',
            //     \DB::raw('SUM(votos_presidenciales.validos) as validos')
            // )
            // ->groupBy('id_mesa')
            // ->get();
            $control_mesas_votacion = \DB::table('votos_presidenciales')
            ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
            ->join('mesas', 'votos_presidenciales.id_mesa', 'mesas.id_mesa')
            ->where('partidos.id_partido', 3)
            ->select(
                'votos_presidenciales.id_mesa', 'votos_presidenciales.id_partido', 'partidos.sigla', 'votos_presidenciales.validos',
                'mesas.numero_votantes'
            )
            ->get();

        }
        $view->with('personas_logueadas', $personas_logueadas)
        ->with('control_mesas_votacion', $control_mesas_votacion);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

