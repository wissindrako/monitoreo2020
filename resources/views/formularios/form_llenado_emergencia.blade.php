<section  id="content" style="background-color: #002640;">


<div class="box box-primary">
        <div class="box-header" style="text-align:center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrar_modal"><span aria-hidden="true">&times;</span></button>
        <h3 class=""><b>Llenado de Mesas - Votos Presidenciales</b></h3>
        <h3 class=""><b>{{$recinto->nombre}}</b> ({{count($mesas)}} mesas)</h3>
				{{-- <input type="hidden" id="rol_usuario" value="{{ $rol->slug }}"> --}}
		</div>
		<!-- /.box-header -->

        {{-- {{dd($votos_presidenciales_r)}} --}}

		<div class="box-body table-responsive no-padding">
		  <table id="tabla_personas" class="table table-hover table_striped_cool table-bordered">
            {{-- <table class="table"> --}}
                    <thead>
                        {{-- <tr style="background-color:#111111; text-align:center; color:white"> --}}
                        <tr>
                        <th style='font-size: 16px; text-align:center; color:#3c8dbc; font-family: "Source Sans Pro"; vertical-align: middle;'>                                    
                            #
                        </th>
                        <th style='font-size: 16px; text-align:center; color:#3c8dbc; font-family: "Source Sans Pro"; vertical-align: middle;'>
                            MESA
                        </th>
                        @foreach ($partidos as $partido)
                        {{-- <th style="text-align:center" width="9%">{{$partido->sigla}}</th> --}}
                        <th style="text-align:left" width="9%">					
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src={{url($partido->logo)}} alt="user image">
                                    <span class="username">
                                        <a href="#">{{$partido->sigla}}</a>
                                    </span>
                                {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                            </div>
                        </th>
                        @endforeach
                        <th style="text-align:left" width="8%">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src={{url('/img/blanco.png')}} alt="user image">
                                    <span class="username">
                                        <a href="#">Blancos</a>
                                    </span>
                                {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                            </div>
                        </th>
                        <th style="text-align:left" width="8%">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src={{url('/img/nulo.png')}} alt="user image">
                                    <span class="username">
                                        <a href="#">Nulos</a>
                                    </span>
                                {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                            </div>
                        </th>
                        <th style="text-align:center" width="1%"></th>
                        <th style="text-align:center" width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($mesas as $key => $mesa)
                        @php
                            $num = $key+1;
                        @endphp
                        @if ($num % 7 == 0)
                        <tr>
                            <th style='font-size: 16px; text-align:center; color:#3c8dbc; font-family: "Source Sans Pro"; vertical-align: middle;'>                                    
                                #
                            </th>
                            <th style='font-size: 16px; text-align:center; color:#3c8dbc; font-family: "Source Sans Pro"; vertical-align: middle;'>
                                MESA
                            </th>
                            @foreach ($partidos as $partido)
                            {{-- <th style="text-align:center" width="9%">{{$partido->sigla}}</th> --}}
                            <th style="text-align:left" width="9%">					
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src={{url($partido->logo)}} alt="user image">
                                        <span class="username">
                                            <a href="#">{{$partido->sigla}}</a>
                                        </span>
                                    {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                                </div>
                            </th>
                            @endforeach
                            <th style="text-align:left" width="8%">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src={{url('/img/blanco.png')}} alt="user image">
                                        <span class="username">
                                            <a href="#">Blancos</a>
                                        </span>
                                    {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                                </div>
                            </th>
                            <th style="text-align:left" width="8%">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src={{url('/img/nulo.png')}} alt="user image">
                                        <span class="username">
                                            <a href="#">Nulos</a>
                                        </span>
                                    {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                                </div>
                            </th>
                            <th style="text-align:center" width="3%"></th>
                        </tr>
                        @endif
                        <tr>
                            <td style='font-size: 15px;'><b>{{$key+1}}</b></td>
                            <td style='font-size: 15px;' scope="row"><b>{{ $mesa->id_mesa }}</b><input type="hidden" name="" id="id_mesa" value="{{$mesa->id_mesa}}"></td>
                            @foreach ($partidos as $partido)
                            <td>
                                @if ($mesa->votos_presidenciales->where('id_partido',$partido->id_partido)->pluck('id_partido')->first() )
                                <div class="form-group" style="text-align:center">
                                <input type="number" name="" id="partido_{{$partido->id_partido}}" min="0" value="{{$mesa->votos_presidenciales->where('id_partido',$partido->id_partido)->pluck('validos')->first()}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" style='width: 80px;'>
                                </div>
                                @else
                                <div class="form-group" style="text-align:center">
                                <input type="number" name="" id="partido_{{$partido->id_partido}}" min="0" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69">
                                </div>
                                @endif
                            </td>
                            @endforeach
                            @if (!is_null($mesa->votos_presidenciales_r ))
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="blancos" min="0" value="{{$mesa->votos_presidenciales_r->where('id_mesa',$mesa->id_mesa)->pluck('blancos')->first()}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" style='width: 80px;'>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="nulos" min="0" value="{{$mesa->votos_presidenciales_r->where('id_mesa',$mesa->id_mesa)->pluck('nulos')->first()}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" style='width: 80px;'>
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="blancos" min="0" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" >
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="nulos" min="0" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" >
                                </div>
                            </td>
                            @endif

                            <td><button type="button" class="btn_mesa btn btn-default btn-xs"><i class="fa fa-fw fa-save"></i></button></td>
                        <td>
                            {{-- <button type="button" class="btn_foto btn btn-default btn-xs"><i class="fa fa-camera"></i>{{ $mesa->id_mesa}}</button> --}}
                            <form>
                                <button type="button" onclick="verinfo_mesas({{$mesa->id_mesa}},20);" class="btn_foto btn btn-default btn-xs"><i class="fa fa-camera"></i></button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
			@if (count($mesas) == 0)
			<div class="box box-primary col-xs-12">
				<div class='aprobado' style="margin-top:70px; text-align: center">
				<label style='color:#177F6B'>
					... no se encontraron resultados para su busqueda...
				</label>
				</div>
			</div>
			@endif
		</div>
		<!-- /.box-body -->
	  </div>

</section>

<script>
    
        $('.table tbody').on('click', '.btn_mesa', function(){
        //   alertify.success('id_gestion:');
        var fila = $(this).closest('tr');
        var id_mesa = fila.find('#id_mesa').val();
        var partido_1 = fila.find('#partido_1').val();
        var partido_2 = fila.find('#partido_2').val();
        var partido_3 = fila.find('#partido_3').val();
        var partido_4 = fila.find('#partido_4').val();
        var partido_5 = fila.find('#partido_5').val();
        var partido_6 = fila.find('#partido_6').val();
        var partido_7 = fila.find('#partido_7').val();
        var partido_8 = fila.find('#partido_8').val();
        var partido_9 = fila.find('#partido_9').val();
        var blancos = fila.find('#blancos').val();
        var nulos = fila.find('#nulos').val();
        // alertify.success('id_mesa: ' + id_mesa + ', p1: ' + partido_1+ ', p2: ' + partido_2+ ', p3: ' + partido_3+ ', p4: ' + partido_4
        // + ', p5: ' + partido_5+ ', p6: ' + partido_6+ ', p7: ' + partido_7+ ', p8: ' + partido_8+ ', p9: ' + partido_9
        // + ', blancos: ' + blancos+ ', nulos: ' + nulos);
        $.ajax({
            // alert('sdaf');
            type:'POST',
            url:"llenado_emergencia", // sending the request to the same page we're on right now
            data:{
                'id_mesa':id_mesa,
                'partido_1':partido_1,
                'partido_2':partido_2,
                'partido_3':partido_3,
                'partido_4':partido_4,
                'partido_5':partido_5,
                'partido_6':partido_6,
                'partido_7':partido_7,
                'partido_8':partido_8,
                'partido_9':partido_9,
                'blancos':blancos,
                'nulos':nulos        
            },
                success: function(result){
                    if (result == 'ok') {
                        alertify.success('Mesa guardada');
                    }
                    else{
                        alertify.success('Mesa guardada');
                    }
                }
            }
        )
        
        });

        </script>

