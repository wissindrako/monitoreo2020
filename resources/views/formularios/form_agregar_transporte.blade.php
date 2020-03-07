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
                      <h3>Agregar Transporte</h3>
                        <p>Por favor llene los siguientes campos</p>
                    </div>
                    <div class="myform-top-right">
                      <i class="fa fa-car"></i>
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

                    <form action="{{ url('agregar_transporte') }}"  method="post" id="f_enviar_gastronomia" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <!--div class="col-md-12">
                            <div class="form-group">
                                <label >Nombre completo del conductor</label>
                                <input type="input" name="conductor" placeholder="" class="form-control" value=""  required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Teléfono de contacto del conductor</label>
                                <input type="input" name="contacto_conductor" placeholder="" class="form-control" value="" required/>
                            </div>
                        </div-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Propietario del Vehiculo</label>
                                <input type="input" name="propietario" placeholder="" class="form-control" value="" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Teléfono de contacto del propietario</label>
                                <input type="input" name="contacto_propietario" placeholder="" class="form-control" value="" required/>
                            </div>
                        </div>
												<div class="col-md-12">
                            <div class="form-group">
                                <label class="text-black ">Organización origen (Del propietario del vehículo)</label>
                                <select class="form-control" name="id_origen" id="id_origen" required>
                                    <option value="" selected> SELECCIONE UNA ORG. ORIGEN </option>
		                                @foreach ($origenes as $origen)
		                                    <option value="{{ $origen->id_origen }}">{{ $origen->origen }}</option>
		                                @endforeach
                                </select>
                            </div>
                        </div>
												<div class="col-md-12">
                            <div class="form-group suborigen_json">
                                <label class="text-black ">Sub organización origen (Del propietario del vehículo)</label>
                                <select class="form-control" name="id_suborigen" id="id_suborigen">
																</select>
                            </div>
                        </div>
												<div class="col-md-12">
                            <div class="form-group">
                                <label class="text-black ">Distrito donde estará el vehículo</label>
                                <select class="form-control" name="distrito" id="distrito" required>
                                    <option value="" selected> --- SELECCIONE UN DISTRITO --- </option>
																		@foreach ($distritos as $distrito)
		                                    <option value="{{ $distrito->distrito }}">{{ "Distrito ".$distrito->distrito }}</option>
		                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Marca del Vehículo</label>
                                <input type="input" name="marca" placeholder="" class="form-control" value="" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Modelo del Vehículo</label>
                                <input type="input" name="modelo" placeholder="" class="form-control" value="" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Placa del Vehículo</label>
                                <input type="input" name="placa" placeholder="" class="form-control" value="" required/>
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
