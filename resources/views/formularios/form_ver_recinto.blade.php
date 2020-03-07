@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection
{{-- @php
    header('Access-Control-Allow-Origin: *');
@endphp --}}

@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container">
            
            <div class="row">
                <div class="box box-primary">
                    <div>
                            {{-- <iframe src="https://goo.gl/maps/huir9fbedLs&output=embed" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe> --}}
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubicación de mi Recinto</h3>
        
                        {{-- <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div> --}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Widget: user widget style 1 -->
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-primary">
                                    <h3 class="widget-user-username">{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}} </h3>
                                    <h5 class="widget-user-desc">{{$rol->description}}</h5>
                                    </div>
                                    <div class="widget-user-image">
                                    {{-- <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar"> --}}
                                    </div>
                                    <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Circunscripción</h5>
                                            @if (!empty($recinto))
                                            <span class="description-text">{{$recinto->circunscripcion}}</span>
                                            @else
                                                Todos
                                            @endif
                                        </div>
                                        <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Distrito</h5>
                                            @if (!empty($recinto))
                                            <span class="description-text">{{$recinto->distrito}}</span>
                                            @else
                                                Todos
                                            @endif
                                        </div>
                                        <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">Recinto</h5>
                                            @if (!empty($recinto))
                                            <span class="description-text">{{$recinto->nombre}}</span>
                                            @else
                                                Todos
                                            @endif
                                        </div>
                                        <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                            <div class="col-md-12">
                                @if (!empty($recinto))
                                <a href="{{$recinto->geolocalizacion}}" target="_blank" class="btn btn-primary btn-lg btn-block">
                                        <i class="fa fa-map-marker"></i> Ver
                                    </a>
                                @else
                                    
                                @endif
                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
