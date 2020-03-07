

<div class="box box-primary col-xs-12">


<div class='aprobado' style="margin-top:70px; text-align: center">
  <span class="label label-success">Realizado <i class="fa fa-check"></i></span><br/>
  <label style='color:#177F6B'>
    Formulario enviado correctamente
  </label> 

</div>

 <div class="margin" style="margin-top:50px; text-align:center;margin-bottom: 50px;">
    <div class="btn-group">
        @if ($msj == 'enviado_crear_persona')
        <a href="{{ url('/form_agregar_persona') }}" class="btn btn-success"    value=" "  > Nueva Persona</a>
        @endif

        @if ($msj == 'enviado_editar_persona')
        <a href="{{ url('/listado_personas') }}" class="btn btn-info"    value=" "  > Regresar</a>
        @endif
      
    </div>
    <div class="btn-group" style="margin-left:50px; " >
      @if ($msj == 'enviado_crear_persona')
      <a href="{{ url('/listado_personas') }}" class="btn btn-info"    value=" "  > Listado</a>
      @endif
      {{-- <a href="{{ url('/') }}" class="btn btn-info"    value=" "  > Salir </a> --}}
    </div>
 </div> 


 

 </div> 

