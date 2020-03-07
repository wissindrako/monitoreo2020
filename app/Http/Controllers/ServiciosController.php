<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ServiciosController extends Controller
{
    public function indexAPI()

    {  
        $usuarios = User::orderBy('created_at', 'desc')->get();
        return $usuarios;
    }
    
    public function getResultados(){
        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
        ->select(
        'recintos.id_loc', 'recintos.municipio',
        'votos_presidenciales.id_partido',
        'partidos.sigla_territorial', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->groupBy('votos_presidenciales.id_partido')
        ->orderby('partidos.nivel')
        ->get();

        // $events = \DB::table('feriados')
        // ->select('feriados.*')
        // ->get();

        // $eventos = array();
        
        $partidos = \DB::table('partidos')
        ->orderBy('nivel')
        ->get();

        $votos_presidenciales_r = \DB::table('votos_presidenciales_r')
        ->select(
            \DB::raw('SUM(blancos) as blancos'),
            \DB::raw('SUM(nulos) as nulos')
        )
        ->first();

        $total_validos = 0;
        
        $detalle_mesas = array();
        $e = array();

        foreach ($partidos as $partido) {
            if (count($votos_presidenciales) > 0) {
                $e["idMunicipio"] = $votos_presidenciales->first()->id_loc;
                $e["municipio"] = $votos_presidenciales->first()->municipio;
                foreach ($votos_presidenciales as $vp) {
                    // $e['id_mesa'] = $votos_presidenciales->id_mesa;
                    if (in_array($partido->id_partido, $votos_presidenciales->pluck('id_partido')->toArray())) {
                        if($partido->id_partido == $vp->id_partido) {
                            $total_validos = $total_validos + $vp->validos;
                            
                            $e[$vp->sigla_territorial] = (int) $vp->validos;
                            
                        }
                    } else {
                        
                        $e[$partido->sigla_territorial] = 0;
                        break;
                    }
                }
            }else{
                $e[$partido->sigla_territorial] = 0;
            }
        }

        $e["validos"] = $total_validos;
        $e["blancos"] = (int) $votos_presidenciales_r->blancos;
        $e["nulos"] = (int) $votos_presidenciales_r->nulos;
        // $eventos = json_encode($eventos);
        array_push($detalle_mesas, $e);

        return $detalle_mesas;
        // return $votos_presidenciales_r->blancos;
        
    }
}
