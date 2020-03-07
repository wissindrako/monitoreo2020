@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')


<section  id="contenido_principal">

{{-- Información sobre vacaciones --}}
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Control de Vacaciones</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Fecha de Ingreso</span>
                    <span class="info-box-number">{{$personal[0]->fechaingreso}}</span>

                    <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                    </div>
                        <span class="progress-description">
                        Inicio en la institución
                        </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Años Calificados</span>
                    @php
                    $hoy = new DateTime(date('Y-m-d'));
                    // $ingreso = new DateTime("2018-02-02");
                    $ingreso = new DateTime($personal[0]->fechaingreso);
                    $antiguedad = $ingreso->diff($hoy);
                    $a = $antiguedad->y. 'a ';
                    $m = $antiguedad->m. 'm ';
                    $d = $antiguedad->d. 'd ';
                    if ($a >= 10 && $d >=1) {
                        $p = 100;
                        $escala = 30;
                        $detalle = ' días habiles';
                    }
                    elseif ($a >= 5 && $d >=1) {
                        $p = $a * 10;
                        $escala = 20;
                        $detalle = ' días habiles';
                    }
                    elseif ($a >= 1 && $d >=1) {
                        $p = $a * 10;
                        $escala = 15;
                        $detalle = ' días habiles';
                    }
                    else {
                        $p = $a * 10;
                        $escala = 0;
                        $detalle = 'No tiene derecho a Vacación';
                    }

                    
                @endphp
                    <span class="info-box-number">@php echo $a.$m.$d; @endphp</span>

                    <div class="progress">
                    <div class="progress-bar" style="width: {{$p}}%"></div>
                    </div>
                        <span class="progress-description">
                        {{$escala.$detalle}}
                        </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-calculator"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Computo</span>
                    @if(count($computo)==0)
                        @php
                            $computo = 0;
                            $saldo = $escala;
                        @endphp
                    @else
                    @php
                        $saldo = $escala-$computo;
                    @endphp
                    @endif
                    <span class="info-box-number">{{round($computo)}} días</span>

                    <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                    </div>
                        <span class="progress-description">
                        Saldo de vacación {{$saldo}}
                        </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-warning"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Vigente hasta</span>
                    <span class="info-box-number">{{$gestion->vigencia}}</span>

                    <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                    </div>
                        <span class="progress-description">
                        A tomar en cuenta
                        </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        {{-- {{$computo}} --}}
    </div>
    <!-- /.box-footer-->
    </div>


<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">1. Datos del Servidor Publico </h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form role="form">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        {{-- <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">  --}}
        <!-- text input -->

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Apellido Paterno</label>
                    <input type="text" class="form-control" disabled value="{{$personal[0]->nombre}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Apellido Materno</label>
                    <input type="text" class="form-control" disabled value="{{$personal[0]->materno}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" class="form-control" disabled value="{{$personal[0]->paterno}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Fecha de presentación</label>                 
                    {{-- <div class="color-palette-set"> --}}
                    {{-- <input type="text" class="form-control" disabled id="hoy"> --}}
                    <div class="form-control" style="border:1px solid #b1cada;"><span id="hoy"></span></div>
                    {{-- </div> --}}
                    {{-- <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Domicilio</label>
                    <input type="text" class="form-control" value="{{$personal[0]->domicilio}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>No. Telefono</label>
                    <input type="text" class="form-control" disabled value="{{$personal[0]->telefono}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>No. Item</label>
                    <input type="number" class="form-control" value="{{$personal[0]->item}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Otorgada en la gestión</label>
                    @php
                        $gestionActual=date('Y', strtotime($personal[0]->fechaingreso));
                    @endphp
                    <input type="text" class="form-control" value="{{$gestionActual}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                    <div class="form-group">
                        <label>Solicitud de vacación a partir del:</label>
        
                        <div class="input-group date">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <!-- /.input group -->
                    </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Cantidad de días de Vacación</label>
                <input type="number" class="form-control" placeholder="{{$saldo}} Días disponibles" max="{{$saldo}}" min="1">
                </div>
            </div>
            <div class="col-md-4">
                {{-- <div class="form-group">
                    <label>Firma</label> --}}
                    {{-- @if(count($personal)==0) --}}
                {{-- <input type="text" class="form-control" value="{{$unidad->nombre}}"> --}}
                {{-- @endif --}}
                {{-- </div> --}}
            </div>
        </div>


        </form>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">2. Autorización del Jefe Inmediato Superior</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        {{-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button> --}}
        </div>
    </div>
    <div class="box-body" style="">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <label>Nombre de la Unidad</label>
                <input type="text" class="form-control" disabled value="{{$personal[0]->unidad}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Autoriza la vacación por:</label>
                    <input type="text" class="form-control" placeholder="...................días">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea class="form-control" rows="3" placeholder="..."></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label>Autorización</label>
            <div style="border:1px solid #b1cada;">
            <div class="row"><br></div>
                <div class="row"><br></div>    
                <div class="row"><br></div>    
                <div class="row"><br></div>
                <div class="row"><br></div>
                <div class="row"><br></div>    
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                    <label class="lead">{{$personal[0]->direccion}}</label>
                    <label for="">Autirización del Jefe Inmediato Superior</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer" style="">
        Footer
    </div>
    </div>
    <!-- /.box-footer-->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">3. Informe de Responsable movilidad y dotación de personal</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {{-- 3. --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Días Otorgados</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Gestión</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Uso de vacación desde Fecha</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Uso de vacación hasta Fecha</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Debe retornar al trabajo en fecha</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control pull-right">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Saldo de vacaciones</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Fecha de ingreso a la institución</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Escala anual de vacación correspondiente</label>
                    <div class="form-control" style="border:1px solid #b1cada;"><span id="hoy"></span></div>
                </div>
            </div>
        </div>
            <div class="col-md-4">
                <label></label>
                <div style="border:1px solid #b1cada;">
                <div class="row"><br></div>
                    <div class="row"><br></div>    
                    <div class="row"><br></div> 
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                        <label class="lead"></label>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-12" style="text-align: center;">
                            <label for=""><small>Firma del funcionario que verifica el computo</small></label>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div>
        <!-- /.box-footer-->
    </div>

</div>

</section>

@endsection


