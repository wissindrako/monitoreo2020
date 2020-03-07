@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container"> 
                    
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Servicios Turísticos</h3>
                            <p>Por favor responda las siguientes preguntas</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-plane"></i>
                        </div>
                      </div>

                  <div class="col-md-12" >
                    @if (count($errors) > 0)
                     
                        <div class="alert alert-danger">
                            <strong>UPPS!</strong> Error al Registrar<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    
                    @endif
                   </div  >

                   <div id="div_notificacion_sol" class="myform-bottom">
                      
                            <form   action="{{ url('enviar_turismo') }}"  method="post" id="f_enviar_turismo" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Cuál es el destino turístico más consultado?</label>
                                <select class="form-control" name="lugar" id="">
                                        <option>Norte Amazonico</option>
                                        <option>Beni - El gran Moxos</option>
                                        <option>Rurrenabaque, Madidi - Pampas</option>
                                        <option>Cordillera Real</option>
                                        <option>Lago Titikaka</option>
                                        <option>Altiplano</option>
                                        <option>Salar de Uyuni y Lagunas de Colores</option>
                                        <option>Tarija y Ruta del Vino y el Singani</option>
                                        <option>Potosi - Chuquisaca</option>
                                        <option>Chaco Boliviano</option>
                                        <option>Misiones Jesuiticas y Santa Cruz</option>
                                        <option>Pantanal</option>
                                        <option>Ruta del Che - Samaipata y Valles Cruceños</option>
                                        <option>Cochabamba: Valles y Cordillera</option>
                                        <option>Tropico Cochabamba, comunidades interculturales y parques nacionales</option>
                                      </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Cantidad de paquetes vendidos o reservados</label>
                                <input type="number" name="venta_paquete" placeholder="" class="form-control" value="" >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Ingreso generado?</label>
                                <input type="number" name="ingreso_turismo" placeholder="" class="form-control" value="" >
                            </div>
                        </div>

                        <button type="submit" class="mybtn">Registrar</button>
                      </form>
                    
                    </div>
              </div>
            </div>
            {{-- <div class="row">
                <div class="col-sm-12 mysocial-login">
                    <h3>...Visitanos en nuestra Pagina</h3>
                    <h1><strong>minculturas.gob.bo</strong>.net</h1>
                </div>
            </div> --}}
        </div>
      </div>
 
</section>

</section>
@endsection