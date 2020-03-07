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
                          <h3>Agregar Lista de Asistencia</h3>
                            <p>Por favor llene los siguientes campos</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-edit"></i>
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

                    <form action="{{ url('agregar_lista_de_asistencia') }}"  method="post" id="f_enviar_gastronomia" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class=" ">Detalle de Asistencia</label>
                                <input type="input" name="detalle" placeholder="" class="form-control" value="" required/>
                            </div>
                            <div class="form-group">
                                <label class=" ">Fecha de la asistencia</label>
                                <input type="date" name="fecha" placeholder="" class="form-control" value="" required/>
                            </div>
                        </div>
                        <button type="submit" class="mybtn">Registrar</button>
                      </form>

                    </div>
              </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
