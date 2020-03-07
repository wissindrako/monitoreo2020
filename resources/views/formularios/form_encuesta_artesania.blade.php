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
                          <h3>Artesanía</h3>
                            <p>Por favor responda las siguientes preguntas</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-joomla"></i>
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
                      
                            <form   action="{{ url('enviar_artesania') }}"  method="post" id="f_enviar_turismo" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      <div class="col-md-12">
                            <div class="form-group">
                                <label >Cuanto ingreso ha generado por su venta?</label>
                                <input type="number" name="ingreso_artesania" placeholder="" class="form-control" value="" >
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