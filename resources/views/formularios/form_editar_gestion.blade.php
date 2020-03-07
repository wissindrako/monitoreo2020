<section  id="content" style="background-color: #002640;">

    <div class="" >
        <div class="container"> 
                    
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           <img  src="{{ url('img/minculturas_logo.png') }}" class="img-responsive logo" />
                          <h3 class="text-muted">Registro de Gestiones</h3>
                            <p class="text-muted">Por favor ingrese sus datos:</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-user"></i>
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

                    <div class="myform-bottom">
                      <h4 class="text-light-blue" >USUARIO: <b>{{$personal[0]->nombre}} {{$personal[0]->paterno}} {{$personal[0]->materno}}</b></h4 class="text-light-blue" >
                    <form   action="{{ url('editar_gestion') }}"  method="post" id="f_editar_gestion" class="formentrada" >
                    
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      {{-- {{dd($ultima_gestion->vigencia)}} --}}
                      <input type="hidden" name="antiguedad" class="form-control" value="{{ $personal[0]->fechaingreso }}">
                      @if($ultima_gestion == null)
                      <input type="hidden" class="form-control" name="id_usuario" id="" value="{{$personal[0]->id_usuario}}">
                        <div class="form-group">
                            <br>
                            <br>
                            <p class="text-light-blue">*El usuario debe agregar las gestiones faltantes a la fecha.</p>
                            <a href="{{ url("/reporte_usuarios") }}"  class="btn btn-default btn-block" >Regresar</a>
                        </div>
                      {{-- <div class="col-md-12">
                          <h4 class="text-muted">Datos de la Gestión</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-muted ">Desde Fecha</label>
                                <input type="text" name="desde" class="form-control" value="{{ $personal[0]->fechaingreso }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                    <label class="text-muted ">Hasta Fecha</label>
                                <input type="text" name="hasta" class="form-control" value="{{ suma_anios($personal[0]->fechaingreso, 1) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label class="text-muted ">Prescribe</label>
                                <input type="text" name="vigencia"  class="form-control" value="{{ suma_anios($personal[0]->fechaingreso, 3) }}" readonly>
                            </div>
                        </div>
                      
                      <hr>
                      <hr>
                      <div class="col-md-12">
                        <h4 class="text-muted">CAS</h4>
                      </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-muted ">Años</label>
                                <input type="number" class="form-control" name="a" placeholder="a"  value="0"  />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-muted ">Meses</label>
                                <input type="number" name="m" placeholder="m" class="form-control" value="0"  />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-muted ">Días</label>
                                <input type="number" name="d" placeholder="d" class="form-control"  value="0"  />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-muted ">Fecha Doc</label>
                                <input type="number" name="fecha_doc" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-muted ">Fecha entrega</label>
                                <input type="number" name="fecha_entrega" class="form-control"  value="" />
                            </div>
                        </div> --}}
                        @else
                        {{-- Si hay gestiones anteriores --}}
                        <input type="hidden" class="form-control" name="id_gestion" id="" value="{{$ultima_gestion->id}}">
                        <div class="col-md-12">
                            <h4 class="text-muted">Datos de la Gestión</h4>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="text-muted ">Desde Fecha</label>
                                  <input type="text" name="desde" class="form-control" value="{{ $ultima_gestion->desde }}" readonly>
                              </div>
                          </div>
                          <div class="col-md-4">
  
                              <div class="form-group">
                                      <label class="text-muted ">Hasta Fecha</label>
                                  <input type="text" name="hasta" class="form-control" value="{{ $ultima_gestion->hasta }}" readonly>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                      <label class="text-muted ">Prescribe</label>
                                  <input type="text" name="vigencia"  class="form-control" value="{{ $ultima_gestion->vigencia }}" readonly>
                              </div>
                          </div>
                        
                        <hr>
                        <hr>
                        <div class="col-md-12">
                          <h4 class="text-muted">CAS</h4>
                        </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label class="text-muted ">Años</label>
                                  <input type="number" class="form-control" name="a" placeholder="a"  value="{{$ultima_gestion->year}}" />
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label class="text-muted ">Meses</label>
                                  <input type="number" name="m" placeholder="m" class="form-control" value="{{$ultima_gestion->month}}" />
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label class="text-muted ">Días</label>
                                  <input type="number" name="d" placeholder="d" class="form-control"  value="{{$ultima_gestion->day}}" />
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="text-muted ">Fecha Doc</label>
                                  <input type="number" name="fecha_doc"  class="form-control" value="{{$ultima_gestion->fecha_doc}}" />
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="text-muted ">Fecha entrega</label>
                                  <input type="number" name="fecha_entrega" class="form-control"  value="{{$ultima_gestion->fecha_entrega}}" />
                              </div>
                          </div>
                        @endif
                          <div class="col-md-12">
                            <br>
                        </div>
                        @if($ultima_gestion == null)

                        @else
                        <button type="submit" class="mybtn">Guardar</button>
                        @endif



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

