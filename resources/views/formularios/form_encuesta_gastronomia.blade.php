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
                          <h3>Gastronomía</h3>
                            <p>Por favor responda las siguientes preguntas</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-cutlery"></i>
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
                      
                    <form action="{{ url('enviar_gastronomia') }}"  method="post" id="f_enviar_gastronomia" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label >Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre Completo" class="form-control" value="{{ old('nombre') }}" >
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label >Cuál es el plato que más a vendido?</label>
                                <div class="form-group">
                                    <select class="form-control" name="plato_preparado" id="">
                                        <option>Wallake</option>
                                        <option>Pesq'e</option>
                                        <option>Ispi</option>
                                        <option>Aji de papa con Ispi</option>
                                        <option>Caldo de Cardán</option>
                                        <option>Fiambre</option>
                                        <option>Sopa de Fideo</option>
                                        <option>Aji de pata</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Cuál es el plato que más a vendido?</label>
                                <div class="form-group">
                                    <select class="form-control" name="plato_preparado" id="">
                                        @foreach ($platos_tarija as $platos)
                                            <option value="{{$platos->plato}}">{{$platos->id}} - {{$platos->plato}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Cuantos platos ha preparado en total?</label>
                                <input type="number" name="platos_preparados" placeholder="0" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Cuantos platos ha vendido?</label>
                                <input type="number" name="platos_vendidos" placeholder="0" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Cual es el costo promedio de sus platos?</label>
                                <input type="number" name="platos_costo" placeholder="0" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label >Cuanto ingreso ha generado por su venta?</label>
                                    <input type="number" name="platos_ingreso" placeholder="0" class="form-control" value="" />
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

