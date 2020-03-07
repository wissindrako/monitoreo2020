@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content" >

    <div class="" >
        <div class="container"> 
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                
                    <div class="myform-top">
                    <div class="myform-top-left">
                        {{-- <img  src="" class="img-responsive logo" /> --}}
                        <h3>Asignación de Delegados por Circunscripción</h3>
                        {{-- <p>Por favor responda las siguientes preguntas</p> --}}
                    </div>
                    <div class="myform-top-right">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    </div>
                    <div id="div_notificacion_sol" class="myform-bottom">
                        <div class="row style="text-align: center;">
                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="text-align: center;">
                                <br><br>
                                <a href="{{ url('delegados_mesa') }}" type="button" class="btn btn-app bg-navy" id="">
                                    {{-- <span class="badge bg-purple">891</span> --}}
                                    <i class="fa fa-file-excel-o"></i> Descargar
                                </a>
                            </div>
                            <div class="col-md-4"></div>
                            {{-- <div class="col-md-4" style="text-align: center;">
                                <a type="button" class="btn btn-app bg-navy" id="btn_plus_cinco_v">
                                    <i class="fa fa-users"></i> +5
                                </a>    
                            </div>
                            <div class="col-md-4" style="text-align: center;">
                                <a type="button" class="btn btn-app bg-navy" id="btn_plus_diez_v">
                                    <i class="fa fa-users"></i> +10
                                </a>    
                            </div>   --}}
                        </div>
                    </div>
              </div>
            </div>

        </div>
      </div>
 
</section>

</section>
@endsection