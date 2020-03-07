<section  id="content" style="background-color: #002640;">

        <div class="" >
            <div class="container"> 
                        
                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                    
                         <div class="myform-top">
                            <div class="myform-top-left">
                               {{-- <img  src="{{ url('img/minculturas_logo.png') }}" class="img-responsive logo" /> --}}
                              <h3 class="text-black">Baja de Usuario</h3>
                                <p class="text-black">Datos de la Persona</p>
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
                       </div>
    
                        <div class="myform-bottom">
                          <h4 class="text-black" >NOMBRE: <b>{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}</b></h4 class="text-black" >
                          <h4 class="text-black" >CEDULA: <b>{{$persona->cedula_identidad}} {{$persona->complemento_cedula}} {{$persona->expedido}}</b></h4 class="text-black" >
                          <h4 class="text-black" >FECHA DE REGISTRO: <b>{{$persona->fecha_registro}}</b></h4 class="text-black" >
                        <form  action="{{ url('baja_persona') }}"  method="post" id="f_baja_persona" class="formentrada" >
                            <input type="hidden" class="form-control" name="id_persona" id="" value="{{$persona->id_persona}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          {{-- {{dd($gestion_actual->vigencia)}} --}}
                          {{-- {{dd($gestion_actual)}} --}}
                          {{-- <input type="hidden" name="antiguedad" class="form-control" value="{{ $persona[0]->fecha_alta }}"> --}}

                            <div class="col-md-12">
                               <br>
                            </div>
                          <button type="submit" class="mybtn">Dar de Baja</button>
                        </form>
                        </div>
                  </div>
                </div>
            </div>
          </div>
     
    </section>
    
    <script>
  $(document).ready(function() {
    function borrado_persona(id_persona){

var urlraiz=$("#url_raiz_proyecto").val();
$("#capa_modal").show();
$("#capa_formularios").show();
var screenTop = $(document).scrollTop();
$("#capa_formularios").css('top', screenTop);
$("#capa_formularios").html($("#cargador_empresa").html());
var miurl=urlraiz+"/form_baja_confirm_persona/"+id_persona+""; 

$.ajax({
url: miurl
}).done( function(resul) 
{
  $("#capa_formularios").html(resul);

}).fail( function(resul) 
{
$("#capa_formularios").html(resul);
}) ;
}

  });
    </script>