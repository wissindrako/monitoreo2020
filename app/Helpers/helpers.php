<?php
/**
 * Created by PhpStorm.
 * User: ghost
 * Date: 29/1/2017
 * Time: 02:42
 */

if(! function_exists('limpiar')){
    function limpiar($string){
        $clean_output = preg_replace("/[A-Za-z]*:[ ]/", "", $string);
        $clean_output = preg_replace("/[(][0-9]*[)][ ]/", "", $clean_output);
        $clean_output = str_replace("Gauge32", "", $clean_output);
        $clean_output = str_replace("Counter32", "", $clean_output);
        $clean_output = preg_replace("/[(][0-9][)]/", "", $clean_output);
        return $clean_output;
    }
}

if(! function_exists('pings')) {
    function pings($ip)
    {
            $output = array();
            exec("ping -n 1 $ip", $output, $status);
            $t= substr($output[8], -8);
            $t=intval(preg_replace('/[^0-9]+/', '', $t),10);
            return $t;
    }
}

if(!function_exists('escala')){
    function escala ($a, $m, $d){
        // $hoy = new DateTime(date('Y-m-d'));
        // $ingreso = new DateTime("2018-02-02");
        // $ingreso = new DateTime($personal[0]->fechaingreso);
        // $antiguedad = $ingreso->diff($hoy);
        $a = 365*$a;
        $m = 30*$m;
        $d = $a + $m + $d;

        if ($d >= (10*365+1)) {
            $escala = 30;
        }
        elseif ($d >= (5*365+1)){
            $escala = 20;
        }
        elseif ($d >= (1*365+1)){
            $escala = 15;
        }
        else {
            $escala = 15;//No tiene derecho a Vacación si tiene menos de un año de antiguedad
        }
        return $escala;
    }
}

if(!function_exists('redondeo_dias')){
    function redondeo_dias($n){
        // $redondeado = $numero - 0.5;
        $aux = (string)$n;
        $entero = intval($n);
        $decimal = substr($aux, strpos($aux, '.'));
        if($decimal >= 0.5){ $numero = $entero + 0.5; }
        else{$numero = $entero;}
    
        return $numero;
    }
}

if(!function_exists('dias_trabajados')){
    function dias_trabajados($baja, $vacaciones){
        // $hoy = new DateTime(date('Y-m-d'));
            // $formato = 'Y-m-d';
            // $baja = DateTime::createFromFormat($formato, '2009-02-15');
            $baja = new DateTime($baja);
            // $baja = date_format($baja, 'Y-m-d');
            $inicio = new DateTime("0000-00-00");
            // $ingreso = new DateTime($baja);
            $anio = $baja->diff($inicio);
            $a = $anio->y. '';
            $m = $anio->m.'';
            $d = $anio->d.'';
            $dias = $m*30 - (30 - $d);
            // $now = $a.'-00-00';
            // $now = new DateTime($now);
            // $interval = $now->diff($baja);
            // $a = $dt->y.'';
            // $a = $antiguedad->y.'';
            // return $interval->format('%a días');
            return $dias - $vacaciones;
    }
}

if(!function_exists('dias_segun_formula')){
    function dias_segun_formula($trabajados, $cas){
        return ($trabajados * $cas) / 360;
    }
}

if(!function_exists('suma_anios')){
    function suma_anios($fecha, $a){
        $nuevafecha = strtotime('+'.$a.' year', strtotime($fecha));
        $nuevafecha = date('Y-m-d', $nuevafecha);
        return $nuevafecha;
    }
}

if(!function_exists('fecha2text')){
    function fecha2text($fecha){
        $texto = $fecha->format('Y-m-d');
        return $texto;
    }
}

if(!function_exists('f_formato')){
    function f_formato($fecha){
        return date("d/m/Y", strtotime($fecha));
    }
}

if(!function_exists('f_formato_array')){
    function f_formato_array($fecha){
        $f = '';
        $fechas = explode(", ", $fecha);
        $fecha = sort($fechas);
        // implode($array,","); 
        if (count($fechas) > 1) {
            foreach ($fechas as &$value ) {
                $value = f_formato($value);
            }
            $f = implode(", ", $fechas);
        }
        else{
            $f = f_formato($fechas[0]);
        }
        return $f;
    }
}

if(!function_exists('salto_n')){
    function salto_n($fecha1, $fecha2, $n){

        $f1 = explode(", ", $fecha1);
        $f2 = explode(", ", $fecha2);
        // implode($array,","); 
        $num1 = count($f1);
        $num2 = count($f2);
        
        $num1 = ceil($num1/$n);
        $num2 = ceil($num2/$n);

        $num = $num1 - $num2;
        $text = "";
        for ($i=0; $i <= $num; $i++) { 
            $text = $text."\r\n";
        }
        return $text;
    }
}

if(!function_exists('dif_fechas')){
    function dif_fechas($fecha1, $fecha2){
        $anio = $fecha1->diff($fecha2);
        $days = $anio->days;

        return $days;
    }
}
