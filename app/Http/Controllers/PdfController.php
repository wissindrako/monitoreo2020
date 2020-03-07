<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use DateTime;
use Fpdf;

use App\User;
use App\Usada;
use App\Vacacion;
use App\Ministerio;
use App\Direccion;
use App\Unidad;
use App\Suspension;

class PdfController extends Controller
{

    public function reporte_fechas_vacaciones(){
        $usuarios=User::paginate(100);
        $hoy = new DateTime(date('Y-m-d'));
        $personal = \DB::table('personal')
        ->join('users', 'personal.cedula', '=', 'users.ci')
        ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
        ->join('areas', 'personal.idarea', '=', 'areas.idarea')
        ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
        ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
        ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
        ->where('gestiones.vigencia', '>', $hoy)
        ->select('personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
        'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
        'unidades.nombre as unidad', 'unidades.id as idunidad',
         'direcciones.nombre as direccion', 'gestiones.*',
        //  \DB::raw("group_concat(start SEPARATOR ', ') as fechas")
        //  \DB::raw('SUM(gestiones.computo) as tomado'),
         \DB::raw('SUM(gestiones.saldo) as saldo_total')
         )
        ->groupBy('gestiones.id_usuario')
        ->get();
        return view("pdfs.reporte_fechas_vacaciones")
        ->with("usuarios",$usuarios)
        ->with("personal", $personal);
    }

    public function reporte_rechazados(){
        $id = Auth::User()->id;
        $usuario=User::find($id);
        
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('suspensiones', 'users.id', '=', 'suspensiones.id_usuario')
            ->join('vacaciones', 'suspensiones.id_vacacion', '=', 'vacaciones.id')
            ->join('estados', 'suspensiones.estado', '=', 'estados.id')
            ->join('usadas', 'suspensiones.id_vacacion', '=', 'usadas.id_solicitud')
            // ->where('personal.idarea', $persona->idarea)
            ->whereBetween('suspensiones.estado', [2, 5])
            ->whereBetween('usadas.id_estado',[9, 12])
            ->select('personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
            'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 'unidades.id as idunidad',
             'direcciones.nombre as direccion', 'suspensiones.*', 'suspensiones.id as id_suspension', 'vacaciones.id as id_solicitud',
             'estados.estado',
             \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
            //  \DB::raw('SUM(usadas.usadas) as dias')
             \DB::raw('COUNT(usadas.usadas) as dias')
             )
            ->groupBy('vacaciones.id')
            ->get();
        return view('pdfs.reporte_rechazados')

            ->with('usuario', $usuario)->with('personal', $personal);
    }

    public function pdf_sol_suspension($id_suspension) {

        $suspension = Suspension::find($id_suspension);
        $id_solicitud = $suspension->id_vacacion;

        $hoy = new DateTime(date('Y-m-d'));

        $solicitud = Vacacion::find($suspension->id_vacacion);//Solicitud suspension

        $user_id = $suspension->id_usuario;
        $usuario=User::find($user_id);
        $personal = \DB::table('personal')
        ->join('users', 'personal.cedula', '=', 'users.ci')
        ->join('cargos', 'personal.id_cargo', '=', 'cargos.idcargo')
        ->join('areas', 'personal.idarea', '=', 'areas.idarea')
        ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
        ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
        ->where('cedula', $usuario->ci)
        ->select('personal.*', 'users.*', 'users.id as id_usuario', 'cargos.*', 'areas.*', 
        'unidades.nombre as unidad',
        'direcciones.nombre as direccion')->get();
        
        $total = Usada::where('id_usuario', $user_id)
        ->where('id_solicitud', $id_solicitud)
        ->whereBetween('id_estado', [9, 11])
        ->select(\DB::raw('SUM(usadas.usadas) as total'))
        ->orderBy('title', 'asc')->get();
        
        $cas = \DB::table('gestiones')
        ->where('gestiones.vigencia', '>', $hoy)
        ->where('id_usuario', $user_id)
        ->select('year', 'month', 'day')
        ->orderBy('id', 'desc')
        ->first();

        $disponibles = \DB::table('users')
        ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
        ->where('users.id', $user_id)
        ->where('gestiones.vigencia', '>', $hoy)
        ->select(\DB::raw('SUM(gestiones.saldo) as saldo'))
        // ->orderBy('gestiones.id', 'asc')
        ->get();

        $usadas = \DB::table('usadas')
        ->select('usadas.*', \DB::raw("group_concat(start SEPARATOR ', ') as inicio, count(start) as numero"))
        ->where('id_solicitud', $id_solicitud)
        ->whereBetween('id_estado', [9, 11])
        ->groupBy('title')
        // ->orderBy('usadas.tiempo')
        ->orderBy('numero', 'desc')      
        ->get();
        
        $hoy = new DateTime(date('Y-m-d'));
        $alta = new DateTime($personal[0]->fechaingreso);
        
        if($personal[0]->fechabaja == null){//con baja
          $antiguedad = $alta->diff($hoy);
        }
        else {
          
          $baja = new DateTime($personal[0]->fechabaja);
          $antiguedad = $alta->diff($baja);
        }
        
        $a = $antiguedad->y. 'a';
        $m = $antiguedad->m. 'm';
        $d = $antiguedad->d. 'd';

        //Functions
        $n = 3;
        if(count($usadas) > 0 ){
            if(count($usadas) == 2){
                $n = 4;
            }
            if(count($usadas) == 3){
                $n = 3;
            }
        }

        $pdf = new Fpdf();
        $pdf::AddPage();

        //CABECERA
        $pdf::Image('img/logochacana.jpg' , 10 ,10, 45 , 12,'JPG');
        $pdf::Cell(45, 5, '', 0);
        $pdf::Cell(100, 5, '', 0,0,'C', 0);
        $pdf::SetFont('Arial', 'B', 14);
        $pdf::Cell(45, 5, '', 0,0,'R', 0);
        // $pdf::Cell(45, 5, 'V-'.str_pad($suspension->id, 4, "0", STR_PAD_LEFT).' / S-'.str_pad($solicitud->id_form_sol, 4, "0", STR_PAD_LEFT), 0,0,'R', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::SetFont('Arial', 'B', 18);
        $pdf::Cell(100, 2, 'SOLICITUD DE SUSPENSIÓN', 0,0,'C', 0);
        $pdf::Cell(45, 2, '', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::Cell(100, 4, '', 0,0,'C',0);
        $pdf::Image('img/logo_encuestas.png' , 170 ,10, 30 , 6,'PNG');
        $pdf::SetFont('Arial', 'B', 12);
        $pdf::Cell(45, 4, 'S-'.str_pad($suspension->id, 4, "0", STR_PAD_LEFT).' / V-'.str_pad($solicitud->id_form_sol, 4, "0", STR_PAD_LEFT).' / '.$solicitud->gestion, 0,0,'R', 0);

        //DATOS PERSONALES
        $pdf::Ln(8);
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DATOS PERSONALES',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Unidad Organizacional:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->unidad,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Nombre:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->nombre.' '.$personal[0]->paterno.' '.$personal[0]->materno,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Fecha de ingreso:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->fechaingreso,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Antiguedad MDCyT:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$a.' '.$m.' '.$d,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'CAS:','LB',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$cas->year.'a '.$cas->month.'m '.$cas->day.'d','RB',0,'L');
        $pdf::Ln(7);

        //DIAS DE VACACION
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DÍAS DE VACACIÓN',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Disponibles','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,($disponibles[0]->saldo),'LRB',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Suspendidas','BR',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,$total[0]->total,'B',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(31,6,'Saldo','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(31,6,($disponibles[0]->saldo + $total[0]->total),'LRB',0,'C');
        $pdf::Ln(9);

        //DETALLE DE DIAS SOLICITADOS
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DETALLE DE DÍAS DE SUSPENSIÓN SOLICITADOS',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',10);
        $h = round(190/count($usadas));
        foreach ($usadas as $i => $item) {
            if($i == count($usadas)-1){
                $pdf::cell(0,6,$item->title,1,"","L");
            }
            else{
                $pdf::cell($h,6,$item->title,1,"","L");
            }
        }
        $pdf::Ln();
        $pdf::SetFont('Arial','',9);
        
            $x = $pdf::GetX();
            $y = $pdf::GetY();
            $push_right = 0;
            $x = $pdf::GetX();
            $y = $pdf::GetY();
            $push_right = 0;
            if (count($usadas) > 0){
            $pdf::MultiCell($w = $h,5,f_formato_array($usadas[0]->inicio),1,'L',0);
            $push_right += $w;
            $pdf::SetXY($x + $push_right, $y);
            }
            if (count($usadas) > 1){
            $pdf::MultiCell($w = $h,5,f_formato_array($usadas[1]->inicio).salto_n($usadas[0]->inicio, $usadas[1]->inicio, $n),1,'L',0);
            // $pdf::MultiCell($w = 63,$y-$y1,f_formato_array($item->inicio),1,'L',0);
            $push_right += $w;
            $pdf::SetXY($x + $push_right, $y);
            // $pdf::MultiCell(0,$y-$y1,"",1,'L',0);
            }
            if (count($usadas) > 2){
            $pdf::MultiCell(0,5,f_formato_array($usadas[2]->inicio).salto_n($usadas[0]->inicio, $usadas[2]->inicio, $n),1,'L',0);
            }
        $pdf::Ln(9);
        
        $pdf::SetFont('Arial','B',10);
        $pdf::cell(24,10,'Observación:','LTB',"","L");
        $pdf::SetFont('Arial','',10);
        $pdf::cell(0,10,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _','TBR',"","L");
        $pdf::Ln();
        $pdf::SetXY($pdf::GetX(), 127);
        $pdf::Ln();
        $pdf::SetFont('Arial','',10);
        $pdf::cell(63,5,'Servidor(a) Público(a)','T',0,'C');
        $pdf::cell(63,5,'','',0,'C');
        $pdf::cell(64,5,'Inmediato Superior / Superior Jerárquico','T',0,'C');
        $pdf::Ln();
        $pdf::cell(0,5,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',0,'','C');


        //CABECERA
        $pdf::Ln(9);
        $pdf::Image('img/logochacana.jpg' , 10 ,151, 45 , 12,'JPG');
        $pdf::Cell(45, 5, '', 0);
        $pdf::Cell(100, 5, '', 0,0,'C', 0);
        $pdf::SetFont('Arial', 'B', 14);
        $pdf::Cell(45, 5, '', 0,0,'R', 0);
        // $pdf::Cell(45, 5, 'V-'.str_pad($suspension->id, 4, "0", STR_PAD_LEFT).' / S-'.str_pad($solicitud->id_form_sol, 4, "0", STR_PAD_LEFT), 0,0,'R', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::SetFont('Arial', 'B', 18);
        $pdf::Cell(100, 2, 'SOLICITUD DE SUSPENSIÓN', 0,0,'C', 0);
        $pdf::Cell(45, 2, '', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::Cell(100, 4, '', 0,0,'C',0);
        $pdf::Image('img/logo_encuestas.png' , 170 ,151, 30 , 6,'PNG');
        $pdf::SetFont('Arial', 'B', 12);
        $pdf::Cell(45, 4, 'S-'.str_pad($suspension->id, 4, "0", STR_PAD_LEFT).' / V-'.str_pad($solicitud->id_form_sol, 4, "0", STR_PAD_LEFT).' / '.$solicitud->gestion, 0,0,'R', 0);

        //DATOS PERSONALES
        $pdf::Ln(8);
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DATOS PERSONALES',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Unidad Organizacional:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->unidad,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Nombre:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->nombre.' '.$personal[0]->paterno.' '.$personal[0]->materno,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Fecha de ingreso:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->fechaingreso,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Antiguedad MDCyT:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$a.' '.$m.' '.$d,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'CAS:','LB',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$cas->year.'a '.$cas->month.'m '.$cas->day.'d','RB',0,'L');
        $pdf::Ln(7);

        //DIAS DE VACACION
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DÍAS DE VACACIÓN',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Disponibles','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,($disponibles[0]->saldo),'LRB',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Suspendidas','BR',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,$total[0]->total,'B',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(31,6,'Saldo','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(31,6,($disponibles[0]->saldo + $total[0]->total),'LRB',0,'C');
        $pdf::Ln(9);

        //DETALLE DE DIAS SOLICITADOS
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DETALLE DE DÍAS DE SUSPENSIÓN SOLICITADOS',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',10);
        $h = round(190/count($usadas));
        foreach ($usadas as $i => $item) {
            if($i == count($usadas)-1){
                $pdf::cell(0,6,$item->title,1,"","L");
            }
            else{
                $pdf::cell($h,6,$item->title,1,"","L");
            }
        }
        $pdf::Ln();
        $pdf::SetFont('Arial','',9);

        $x = $pdf::GetX();
        $y = $pdf::GetY();
        $push_right = 0;
        $x = $pdf::GetX();
        $y = $pdf::GetY();
        $push_right = 0;
        if (count($usadas) > 0){
        $pdf::MultiCell($w = $h,5,f_formato_array($usadas[0]->inicio),1,'L',0);
        $push_right += $w;
        $pdf::SetXY($x + $push_right, $y);
        }
        if (count($usadas) > 1){
        $pdf::MultiCell($w = $h,5,f_formato_array($usadas[1]->inicio).salto_n($usadas[0]->inicio, $usadas[1]->inicio, $n),1,'L',0);
        // $pdf::MultiCell($w = 63,$y-$y1,f_formato_array($item->inicio),1,'L',0);
        $push_right += $w;
        $pdf::SetXY($x + $push_right, $y);
        // $pdf::MultiCell(0,$y-$y1,"",1,'L',0);
        }
        if (count($usadas) > 2){
        $pdf::MultiCell(0,5,f_formato_array($usadas[2]->inicio).salto_n($usadas[0]->inicio, $usadas[2]->inicio, $n),1,'L',0);
        }
        $pdf::Ln(9);
        
        $pdf::SetFont('Arial','B',10);
        $pdf::cell(24,10,'Observación:','LTB',"","L");
        $pdf::SetFont('Arial','',10);
        $pdf::cell(0,10,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _','TBR',"","L");
        $pdf::SetXY($pdf::GetX(), 261);
        $pdf::Ln();
        $pdf::SetFont('Arial','',10);
        $pdf::cell(63,5,'Servidor(a) Público(a)','T',0,'C');
        $pdf::cell(63,5,'','',0,'C');
        $pdf::cell(64,5,'Inmediato Superior / Superior Jerárquico','T',0,'C');
        $pdf::Ln();
        $pdf::Output();
        exit;
    }

    public function pdf_sol_vacacion($id_solicitud) {
        $hoy = new DateTime(date('Y-m-d'));
        $solicitud = Vacacion::find($id_solicitud);
        $users = User::all();
        $user_id = $solicitud->id_usuario;
        $usuario=User::find($user_id);
        $personal = \DB::table('personal')
        ->join('users', 'personal.cedula', '=', 'users.ci')
        ->join('cargos', 'personal.id_cargo', '=', 'cargos.idcargo')
        ->join('areas', 'personal.idarea', '=', 'areas.idarea')
        ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
        ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
        ->where('cedula', $usuario->ci)
        ->select('personal.*', 'users.*', 'users.id as id_usuario', 'cargos.*', 'areas.*', 
        'unidades.nombre as unidad', 
        'direcciones.nombre as direccion')->get();
        
        $total = Usada::where('id_usuario', $user_id)
        ->where('id_solicitud', $id_solicitud)
        ->select(\DB::raw('SUM(usadas.usadas) as total'))
        ->orderBy('title', 'asc')->get();
        
        $cas = \DB::table('gestiones')
        ->where('gestiones.vigencia', '>', $hoy)
        ->where('id_usuario', $user_id)
        ->select('year', 'month', 'day')
        ->orderBy('id', 'desc')
        ->first();

        $disponibles = \DB::table('users')
        ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
        ->where('users.id', $user_id)
        ->where('gestiones.vigencia', '>', $hoy)
        ->select(\DB::raw('SUM(gestiones.saldo) as saldo'))
        // ->orderBy('gestiones.id', 'asc')
        ->get();

        $usadas = \DB::table('usadas')
        ->select('usadas.*', \DB::raw("group_concat(start SEPARATOR ', ') as inicio, count(start) as numero"))
        ->where('id_solicitud', $id_solicitud)
        ->groupBy('title')
        // ->orderBy('usadas.tiempo')
        ->orderBy('numero', 'desc')      
        ->get();
        
        $hoy = new DateTime(date('Y-m-d'));
        $alta = new DateTime($personal[0]->fechaingreso);
        
        if($personal[0]->fechabaja == null){//con baja
          $antiguedad = $alta->diff($hoy);
        }
        else {
          
          $baja = new DateTime($personal[0]->fechabaja);
          $antiguedad = $alta->diff($baja);
        }
        
        $a = $antiguedad->y. 'a';
        $m = $antiguedad->m. 'm';
        $d = $antiguedad->d. 'd';

        //Functions
        $n = 3;
        if(count($usadas) > 0 ){
            if(count($usadas) == 2){
                $n = 4;
            }
            if(count($usadas) == 3){
                $n = 3;
            }
        }


        $pdf = new Fpdf();
        $pdf::AddPage();

        //CABECERA
        $pdf::Image('img/logochacana.jpg' , 10 ,10, 45 , 12,'JPG');
        $pdf::Cell(45, 5, '', 0);
        $pdf::Cell(100, 5, '', 0,0,'C', 0);
        $pdf::SetFont('Arial', 'B', 14);
        $pdf::Cell(45, 5, '', 0,0,'R', 0);
        // $pdf::Cell(45, 5, 'V-'.str_pad($solicitud->id_form_sol, 6, "0", STR_PAD_LEFT), 0,0,'R', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::SetFont('Arial', 'B', 18);
        $pdf::Cell(100, 2, 'SOLICITUD DE VACACIÓN', 0,0,'C', 0);     
        $pdf::Cell(45, 2, '', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::Cell(100, 4, '', 0,0,'C',0);
        $pdf::Image('img/logo_encuestas.png' , 170 ,10, 30 , 6,'PNG');
        $pdf::SetFont('Arial', 'B', 12);
        $pdf::Cell(45, 4, 'V-'.str_pad($solicitud->id_form_sol, 5, "0", STR_PAD_LEFT).' / '.$solicitud->gestion, 0,0,'R', 0);

        //DATOS PERSONALES
        $pdf::Ln(8);
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DATOS PERSONALES',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Unidad Organizacional:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->unidad,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Nombre:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->nombre.' '.$personal[0]->paterno.' '.$personal[0]->materno,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Fecha de ingreso:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,f_formato($personal[0]->fechaingreso),'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Antiguedad MDCyT:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$a.' '.$m.' '.$d,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'CAS:','LB',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$cas->year.'a '.$cas->month.'m '.$cas->day.'d','RB',0,'L');
        $pdf::Ln(7);

        //DIAS DE VACACION
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DÍAS DE VACACIÓN',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Disponibles','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,$disponibles[0]->saldo,'LRB',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Solicitados','B',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,$total[0]->total,'LB',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(31,6,'Saldo','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(31,6,($disponibles[0]->saldo - $total[0]->total),'LRB',0,'C');
        $pdf::Ln(9);

        //DETALLE DE DIAS SOLICITADOS
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DETALLE DE DÍAS SOLICITADOS',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',10);
        $h = round(190/count($usadas));
        foreach ($usadas as $i => $item) {
            if($i == count($usadas)-1){
                $pdf::cell(0,6,$item->title,1,"","L");
            }
            else{
                $pdf::cell($h,6,$item->title,1,"","L");
            }
        }
        $pdf::Ln();
        $pdf::SetFont('Arial','',9);
        
            $x = $pdf::GetX();
            $y = $pdf::GetY();
            $push_right = 0;
            $x = $pdf::GetX();
            $y = $pdf::GetY();
            $push_right = 0;
            if (count($usadas) > 0){
            $pdf::MultiCell($w = $h,5,f_formato_array($usadas[0]->inicio),1,'L',0);
            $push_right += $w;
            $pdf::SetXY($x + $push_right, $y);
            }
            if (count($usadas) > 1){
            $pdf::MultiCell($w = $h,5,f_formato_array($usadas[1]->inicio).salto_n($usadas[0]->inicio, $usadas[1]->inicio, $n),1,'L',0);
            $push_right += $w;
            $pdf::SetXY($x + $push_right, $y);
            }
            if (count($usadas) > 2){
            $pdf::MultiCell(0,5,f_formato_array($usadas[2]->inicio).salto_n($usadas[0]->inicio, $usadas[2]->inicio, $n),1,'L',0);
            }
        
        $pdf::Ln();
        $pdf::SetFont('Arial','B',10);
        $pdf::cell(0,7,'Yo '.$personal[0]->nombre.' '.$personal[0]->paterno.' '.$personal[0]->materno.' declaro que mi trabajo se encuentra en orden.','0',"","R");
        $pdf::Ln(10);
        $pdf::SetFont('Arial','B',10);
        $pdf::cell(24,9,'Observación:','LTB',"","L");
        $pdf::SetFont('Arial','',10);
        // $pdf::cell(0,9,'','TBR',"","L");
        $pdf::cell(0,9,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _','TBR',"","L");
        $pdf::Ln();
        $pdf::SetXY($pdf::GetX(), 127);
        $pdf::Ln();
        $pdf::SetFont('Arial','',10);
        $pdf::cell(63,5,'Servidor(a) Público(a)','T',0,'C');
        $pdf::cell(63,5,'','',0,'C');
        $pdf::cell(64,5,'Inmediato Superior / Superior Jerárquico','T',0,'C');
        $pdf::Ln();
        $pdf::cell(0,5,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',0,'','C');
    

        //CABECERA
        $pdf::Ln(9);
        $pdf::Image('img/logochacana.jpg' , 10 ,151, 45 , 12,'JPG');
        $pdf::Cell(45, 5, '', 0);
        $pdf::Cell(100, 5, '', 0,0,'C', 0);
        $pdf::SetFont('Arial', 'B', 14);
        $pdf::Cell(45, 5, '', 0,0,'R', 0);
        // $pdf::Cell(45, 5, 'V-'.str_pad($solicitud->id_form_sol, 6, "0", STR_PAD_LEFT), 0,0,'R', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::SetFont('Arial', 'B', 18);
        $pdf::Cell(100, 2, 'SOLICITUD DE VACACIÓN', 0,0,'C', 0);     
        $pdf::Cell(45, 2, '', 0);
        $pdf::Ln();
        $pdf::Cell(45, 2, '', 0);
        $pdf::Cell(100, 4, '', 0,0,'C',0);
        $pdf::Image('img/logo_encuestas.png' , 170 ,151, 30 , 6,'PNG');
        $pdf::SetFont('Arial', 'B', 12);
        $pdf::Cell(45, 4, 'V-'.str_pad($solicitud->id_form_sol, 5, "0", STR_PAD_LEFT).' / '.$solicitud->gestion, 0,0,'R', 0);

        //DATOS PERSONALES
        $pdf::Ln(8);
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DATOS PERSONALES',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Unidad Organizacional:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->unidad,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Nombre:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$personal[0]->nombre.' '.$personal[0]->paterno.' '.$personal[0]->materno,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Fecha de ingreso:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,f_formato($personal[0]->fechaingreso),'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'Antiguedad MDCyT:','L',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$a.' '.$m.' '.$d,'R',0,'L');
        $pdf::Ln();
        $pdf::SetFont('Arial','B',8);
        $pdf::cell(50,4,'CAS:','LB',0,'');
        $pdf::SetFont('Arial','',8);
        $pdf::cell(0,4,$cas->year.'a '.$cas->month.'m '.$cas->day.'d','RB',0,'L');
        $pdf::Ln(7);

        //DIAS DE VACACION
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DÍAS DE VACACIÓN',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Disponibles','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,$disponibles[0]->saldo,'LRB',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(32,6,'Solicitados','B',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(32,6,$total[0]->total,'LB',0,'C');
        $pdf::SetFont('Arial','',11);
        $pdf::cell(31,6,'Saldo','LRB',0,'C');
        $pdf::SetFont('Arial','B',11);
        $pdf::cell(31,6,($disponibles[0]->saldo - $total[0]->total),'LRB',0,'C');
        $pdf::Ln(9);

        //DETALLE DE DIAS SOLICITADOS
        $pdf::SetFont('Arial','B',11);
        $pdf::SetFillColor(216, 216, 216);
        $pdf::cell(0,6,'DETALLE DE DÍAS SOLICITADOS',1, 0, 'C', true);
        $pdf::SetFillColor(255, 255, 255);
        $pdf::Ln();
        $pdf::SetFont('Arial','B',10);
        $h = round(190/count($usadas));
        foreach ($usadas as $i => $item) {
            if($i == count($usadas)-1){
                $pdf::cell(0,6,$item->title,1,"","L");
            }
            else{
                $pdf::cell($h,6,$item->title,1,"","L");
            }
        }
        $pdf::Ln();
        $pdf::SetFont('Arial','',9);

        $x = $pdf::GetX();
        $y = $pdf::GetY();
        $push_right = 0;
        $x = $pdf::GetX();
        $y = $pdf::GetY();
        $push_right = 0;
        if (count($usadas) > 0){
        $pdf::MultiCell($w = $h,5,f_formato_array($usadas[0]->inicio),1,'L',0);
        $push_right += $w;
        $pdf::SetXY($x + $push_right, $y);
        }
        if (count($usadas) > 1){
        $pdf::MultiCell($w = $h,5,f_formato_array($usadas[1]->inicio).salto_n($usadas[0]->inicio, $usadas[1]->inicio, $n),1,'L',0);
        // $pdf::MultiCell($w = 63,$y-$y1,f_formato_array($item->inicio),1,'L',0);
        $push_right += $w;
        $pdf::SetXY($x + $push_right, $y);
        // $pdf::MultiCell(0,$y-$y1,"",1,'L',0);
        }
        if (count($usadas) > 2){
        $pdf::MultiCell(0,5,f_formato_array($usadas[2]->inicio).salto_n($usadas[0]->inicio, $usadas[2]->inicio, $n),1,'L',0);
        }
        $pdf::Ln();
        $pdf::SetFont('Arial','B',10);
        $pdf::cell(0,7,'Yo '.$personal[0]->nombre.' '.$personal[0]->paterno.' '.$personal[0]->materno.' declaro que mi trabajo se encuentra en orden.','0',"","R");
        $pdf::Ln(10);
        $pdf::SetFont('Arial','B',10);
        $pdf::cell(24,9,'Observación:','LTB',"","L");
        $pdf::SetFont('Arial','',10);
        // $pdf::cell(0,9,'','TBR',"","L");
        $pdf::cell(0,9,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _','TBR',"","L");
        $pdf::Ln();
        $pdf::SetXY($pdf::GetX(), 260);
        $pdf::Ln();
        $pdf::SetFont('Arial','',10);
        $pdf::cell(63,5,'Servidor(a) Público(a)','T',0,'C');
        $pdf::cell(63,5,'','',0,'C');
        $pdf::cell(64,5,'Inmediato Superior / Superior Jerárquico','T',0,'C');

        $pdf::Output();
        exit;
    }

    public function reporte_funcionario(){//$id_min, $id_dir, $id_uni
        $id_min = $_GET['id_min'];
        $id_dir = $_GET['id_dir'];
        $id_uni = $_GET['id_uni'];
        $ranking = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('ministerios', 'areas.idmin', '=', 'ministerios.id')
            ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
            // ->join('vacaciones', 'users.id', '=', 'vacaciones.id_usuario')
            // ->join('estados', 'vacaciones.id_estado', '=', 'estados.id')
            ->join('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
            //poner solo de gestiones activas
            // ->where('areas.idmin', $id_min)
            // ->where('areas.iddireccion', $id_dir)
            // ->where('areas.idunidad', $id_uni)
            // ->where('personal.idarea', $persona->idarea)
            // ->where('vacaciones.id_estado', '=', 3)
            ->select('ministerios.nombre as ministerio', 'direcciones.nombre as direccion', 'unidades.nombre as unidad', 'personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
            'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 'unidades.id as idunidad',
             'direcciones.nombre as direccion', 
            //  'vacaciones.*', 'vacaciones.id as id_solicitud',
            //  'estados.estado',
             \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
             \DB::raw('SUM(usadas.usadas) as dias')
             )
            ->groupBy('gestiones.id_usuario')
            ->get();
        return $ranking;
    }

    public function ranking_vacaciones(){//$id_min, $id_dir, $id_uni

        $hoy = new DateTime(date('Y-m-d'));
        // $hoy = new DateTime("2020-02-17");
        $id_min = $_GET['id_min'];
        $id_dir = $_GET['id_dir'];
        $id_uni = $_GET['id_uni'];
        $ranking = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('ministerios', 'areas.idmin', '=', 'ministerios.id')
            ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
            // ->join('vacaciones', 'users.id', '=', 'vacaciones.id_usuario')
            // ->join('estados', 'vacaciones.id_estado', '=', 'estados.id')
            // ->join('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
            //poner solo de gestiones activas
            ->where('gestiones.vigencia', '>', $hoy)
            ->where('areas.idmin', $id_min)
            ->where('areas.iddireccion', $id_dir)
            ->where('areas.idunidad', $id_uni)
            // ->where('personal.idarea', $persona->idarea)
            // ->where('vacaciones.id_estado', '=', 3)
            ->select('ministerios.nombre as ministerio', 'direcciones.nombre as direccion', 'unidades.nombre as unidad', 
            'personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
            'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 'unidades.id as idunidad',
            'direcciones.nombre as direccion', 
            'gestiones.desde', 'gestiones.hasta', 'gestiones.vigencia',
            // 'vacaciones.*', 'vacaciones.id as id_solicitud',
            // 'estados.estado',
            //  \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
             \DB::raw('SUM(gestiones.computo) as dias'),
             \DB::raw('SUM(gestiones.saldo) as total_saldo')
             )
            // ->groupBy('gestiones.id')
            ->groupBy('users.id')
            ->orderBy('total_saldo', 'desc')
            ->get();
        return $ranking;
    }

    public function reporte_ranking_vacaciones(){

        $hoy = new DateTime(date('Y-m-d'));

        $id = Auth::User()->id;
        $usuario=User::find($id);

        $ministerios = Ministerio::all();
        $direcciones = Direccion::all();
        $unidades = Unidad::all();

        $ranking = \DB::table('personal')
        ->join('users', 'personal.cedula', '=', 'users.ci')
        ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
        ->join('areas', 'personal.idarea', '=', 'areas.idarea')
        ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
        ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
        ->join('ministerios', 'areas.idmin', '=', 'ministerios.id')
        ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
        // ->join('vacaciones', 'users.id', '=', 'vacaciones.id_usuario')
        // ->join('estados', 'vacaciones.id_estado', '=', 'estados.id')
        // ->join('usadas', 'gestiones.id', '=', 'usadas.id_gestion')
        //poner solo de gestiones activas
        ->where('gestiones.vigencia', '>', $hoy)

        // ->where('personal.idarea', $persona->idarea)
        // ->where('vacaciones.id_estado', '=', 3)
        ->select('ministerios.nombre as ministerio', 'direcciones.nombre as direccion', 'unidades.nombre as unidad', 
        'personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
        'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
        'unidades.nombre as unidad', 'unidades.id as idunidad',
        'direcciones.nombre as direccion', 
        'gestiones.desde', 'gestiones.hasta', 'gestiones.vigencia',
        // 'vacaciones.*', 'vacaciones.id as id_solicitud',
        // 'estados.estado',
        //  \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
         \DB::raw('SUM(gestiones.computo) as dias'),
         \DB::raw('SUM(gestiones.saldo) as total_saldo')
         )
        // ->groupBy('gestiones.id')
        ->groupBy('users.id')
        ->orderBy('total_saldo', 'desc')
        ->get();
        
        $personal = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('cargos', 'personal.item', '=', 'cargos.idcargo')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
            ->join('vacaciones', 'users.id', '=', 'vacaciones.id_usuario')
            ->join('estados', 'vacaciones.id_estado', '=', 'estados.id')
            ->join('usadas', 'vacaciones.id', '=', 'usadas.id_solicitud')
            // ->where('personal.idarea', $persona->idarea)
            ->where('vacaciones.id_estado', '=', 3)
            ->select('personal.fechaingreso', 'personal.item', 'personal.idarea', 'users.id as id_usuario',
            'users.ci', 'users.nombre', 'users.paterno','users.materno', 'cargos.*', 'areas.*', 
            'unidades.nombre as unidad', 'unidades.id as idunidad',
             'direcciones.nombre as direccion', 'vacaciones.*', 'vacaciones.id as id_solicitud',
             'estados.estado',
             \DB::raw("group_concat(start SEPARATOR ', ') as fechas"),
             \DB::raw('SUM(usadas.usadas) as dias')
             )
            ->groupBy('vacaciones.id')
            ->get();
        return view('pdfs.reporte_ranking_vacaciones')
            ->with('ministerios', $ministerios)
            ->with('direcciones', $direcciones)
            ->with('unidades', $unidades)
            ->with('usuario', $usuario)
            ->with('personal', $personal)
            ->with('ranking', $ranking);
    }

    public function pdf_solicitud_vacacion($id_solicitud){
        $hoy = new DateTime(date('Y-m-d'));
        $users = User::all();
        $user_id = Auth::user()->id;
        $usuario=User::find($user_id);
        $personal = \DB::table('personal')
        ->join('users', 'personal.cedula', '=', 'users.ci')
        ->join('cargos', 'personal.id_cargo', '=', 'cargos.idcargo')
        ->join('areas', 'personal.idarea', '=', 'areas.idarea')
        ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
        ->join('direcciones', 'areas.iddireccion', '=', 'direcciones.id')
        ->where('cedula', $usuario->ci)
        ->select('personal.*', 'users.*', 'users.id as id_usuario', 'cargos.*', 'areas.*', 
        'unidades.nombre as unidad', 
        'direcciones.nombre as direccion')->get();
        
        $total = Usada::where('id_usuario', $user_id)
        ->where('id_solicitud', $id_solicitud)
        ->select(\DB::raw('SUM(usadas.usadas) as total'))

        ->orderBy('title', 'asc')->get();
        $disponibles = \DB::table('users')
        ->join('gestiones', 'users.id', '=', 'gestiones.id_usuario')
        ->where('users.id', $user_id)
        ->where('gestiones.vigencia', '>', $hoy)
        ->select(\DB::raw('SUM(gestiones.saldo) as saldo'))->get();

        $usadas = \DB::table('usadas')
                                ->select('usadas.*', DB::raw("group_concat(start SEPARATOR ', ') as inicio"))
                                ->where('id_solicitud', $id_solicitud)
                                ->groupBy('start')
                                ->get();

        // $solicitud = Vacacion::find($id_solicitud);
        //$solicitud->id_estado = 2; //SOLICITADA

        // if($solicitud->save()){
            return view('pdfs.pdf_solicitud_vacacion')
            ->with('total', $total)
            ->with('disponibles', $disponibles)
            ->with('usadas', $usadas)
            ->with('users', $users)
            ->with('personal', $personal);
        // }
        // else{
            // return 'Hubo un error al enviar su solicitud, verifique su conectividad';
        // }


    }
}
