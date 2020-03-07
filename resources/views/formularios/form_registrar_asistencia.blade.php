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
                          <h3>Registrar Asistencia</h3>
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
											<br>
                    	<form action="{{ url('registrar_asistencia') }}"  method="post" id="f_enviar_gastronomia" class="formentrada" >
                        <button type="submit" class="mybtn" style="background-color: #60C28B;">Estoy presente</button>
                      </form>
											<br><br><br>
											<form action="{{ url('registrar_falta') }}"  method="post" id="f_enviar_gastronomia" class="formentrada" >
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <label class=" ">Motivo de Inasistencia</label>
	                                <input type="text" maxlength="250" name="observacion" placeholder="" class="form-control" required/>
	                            </div>
	                        </div>
	                        <button type="submit" class="mybtn" style="background-color: #DF6469;">No podré asistir</button>
	                      </form>

                    </div>
              </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
