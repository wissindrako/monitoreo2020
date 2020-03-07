<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
  <title>Documento PDF</title>
</head>
<body>
{{-- {{dd($total)}} --}}
<div class="col-md-12">
  <div class="row">
    <div class="col-md-4">
      <br>
      <img  src="img/minculturas_logo.png" style="width:200px;height:50px;" class="img-responsive logo" />
    </div>
    <div class="col-md-4">
      
    </div>
    <div class="col-md-4" style="text-align:center">
      <h3>Formulario de solicitud de vacación</h3>
    </div>
  </div>
  <div class="row">
    <div class="box box-success">
        <div class="box-header">
          @php
          $hoy = new DateTime(date('Y-m-d'));
          $alta = new DateTime($personal[0]->fechaingreso);
          
          if($personal[0]->fechabaja == null){//con baja
            $antiguedad = $alta->diff($hoy);
          }
          else {
            
            $baja = new DateTime($personal[0]->fechabaja);
            $antiguedad = $alta->diff($baja);
          }
          
          $a = $antiguedad->y. 'a ';
          $m = $antiguedad->m. 'm ';
          $d = $antiguedad->d. 'd ';
      @endphp
      <div class="box-header">
        <h3 class="box-title"><b>Datos Personales: </b></h3><br><br>
        <h3 class="box-title">{{$personal[0]->unidad}}</h3><br>
        <h3 class="box-title">{{$personal[0]->nombre}} {{$personal[0]->paterno}} {{$personal[0]->materno}}</h3><br>
        <h3 class="box-title">Fecha de Ingreso: {{$personal[0]->fechaingreso}} </h3>
        @if($personal[0]->fechabaja == null)
        {{-- <h3 class="box-title">Fecha de Ingreso: {{fecha2text($baja)}} </h3> --}}
        @else 
            - <span class="badge bg-red"><h3 class="box-title">Fecha de Baja: {{fecha2text($baja)}}</h3></span> 
        @endif
      
        <br> <h3 class="box-title"> Antiguedad MDCyT: {{$a}} {{$m}} {{$d}} </h3>
      </div>
      
      </div>
    </div>

  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="box box-solid">
      <div class="col-md-12">
        <div class="box-header">
          <h3 class="box-title"><b>Detalle de días solicitados: </b></h3>
        </div>
        <div class="col-md-8"></div>
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-9">
        <div class="box-body">
            @foreach ($usadas as $item)
              <ul>
                <li>{{$item->title}}</li>
                  <ul>
                    <li>{{$item->inicio}}</li>
                  </ul>
              </ul>
            @endforeach
          </div>
      </div>
      <!-- /.box-header -->
      <div class="row">
        <div class="col-md-6" style="text-align:center";>
        <h5><b>Días disponibles: {{$disponibles[0]->saldo - $total[0]->total}}</b></h5>
        </div>
        <div class="col-md-6" style="text-align:center";>
        <h5><b>Total días solicitados: {{$total[0]->total}}</b></h5>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- ./col -->

</div>
<br><br><br>
<div class="row">
  <div class="col-md-12" style="display:inline-block; text-align:center;">
      <div style="clear:both; position:relative; text-align:center;">
          <div style="position:absolute; left:0pt; width:192pt;">
              <h4>---------------------------------</h4>
              <h4>Firma</h4>
              <h4>Funcionario</h4>
          </div>
          <div style="margin-left:200pt;">
              <h4>---------------------------------</h4>
              <h4>Firma</h4>
              <h4>Jefe Inmediato Superior</h4>
          </div>
      </div>
  </div>
</div>
</body>
</html>


@php

    include('../public/plugins/dompdf/autoload.inc.php');
    use Dompdf\Dompdf;

	$dompdf = new DOMPDF();
	$dompdf->loadHtml(ob_get_clean());
	// $dompdf->set_paper('A4', 'landscape');
	// ini_set("memory_limit","32M");
	$dompdf->render();
	$pdf = $dompdf->output();

	$dompdf->stream(
        // "form_101-".$id_sol.".pdf", array('Attachment' => true)
        "form_101.pdf", array('Attachment' => false)
	);

@endphp