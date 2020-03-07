@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
{{-- 
	<div style='overflow-x:scroll;overflow-y:hidden;'>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Charts</b></div>
					<div class="panel-body">
						<canvas id="canvas" height="280" width="800"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

	{{-- INICIO CIRCUNSCRIPCION 10 --}}
	<div class="box box-primary">
		<a href="javascript:void(0);" onclick="refrescar_votos();">
			<div class="box-header with-border" style="background-color:#3c8dbc; text-align:center">
			<h3 class="box-title" style="color:white">Votos Uninominales Circunscripción 10</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool bg-black"><i class="fa fa-refresh text-aqua" id="btn_refresh"></i></button>
			</div>
			</div>
		</a>
		<div class="box-body" style="">
		  <div class="chart">
			<canvas id="canvas_c10"  height="230" width="754"></canvas>
		  </div>
		
		<!-- /.box-body -->

		<div class="row">
			{{-- <div class="col-lg-3 col-xs-6">
			</div> --}}
			<div class="col-lg-6 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-gray">
				<div class="inner">
				  <h4><b>{{$circ_10->blancos}}</b></h4>
	
				  <p><b>Blancos</b></p>
				</div>
				<div class="icon">
				  <i class="fa fa-circle-o"></i>
				</div>
				<br>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-6 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-gray">
				<div class="inner">
				  <h4><b>{{$circ_10->nulos}}</b></h4>
	
				  <p><b>Nulos</b></p>
				</div>
				<div class="icon">
				  <i class="fa fa-times-circle"></i>
				</div>
				<br>
			  </div>
			</div>
			<!-- ./col -->
		  </div>
		</div>
	</div>
	{{-- FIN CIRCUNSCRIPCION 10 --}}

	{{-- INICIO CIRCUNSCIPCION 11 --}}
	<div class="box box-primary">
		<a href="javascript:void(0);" onclick="refrescar_votos();">
			<div class="box-header with-border" style="background-color:#3c8dbc; text-align:center">
				<h3 class="box-title" style="color:white">Votos Uninominales Circunscripción 11</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool bg-black"><i class="fa fa-refresh text-aqua" id="btn_refresh"></i></button>
				</div>
			</div>
		</a>
		<div class="box-body" style="">
			<div class="chart">
			<canvas id="canvas_c11"  height="230" width="754"></canvas>
			</div>
		
		<!-- /.box-body -->

		<div class="row">
			{{-- <div class="col-lg-3 col-xs-6">
			</div> --}}
			<div class="col-lg-6 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-gray">
				<div class="inner">
					<h4><b>{{$circ_11->blancos}}</b></h4>
	
					<p><b>Blancos</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-circle-o"></i>
				</div>
				<br>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-6 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-gray">
				<div class="inner">
					<h4><b>{{$circ_11->nulos}}</b></h4>
	
					<p><b>Nulos</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-times-circle"></i>
				</div>
				<br>
				</div>
			</div>
			<!-- ./col -->
			</div>
		</div>
	</div>
	{{-- FIN CIRCUNSCRIPCION 11 --}}

	{{-- INICIO CIRCUNSCIPCION 12 --}}
	<div class="box box-primary">
		<a href="javascript:void(0);" onclick="refrescar_votos();">
			<div class="box-header with-border" style="background-color:#3c8dbc; text-align:center">
				<h3 class="box-title" style="color:white">Votos Uninominales Circunscripción 12</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool bg-black"><i class="fa fa-refresh text-aqua" id="btn_refresh"></i></button>
				</div>
			</div>
		</a>
		<div class="box-body" style="">
			<div class="chart">
			<canvas id="canvas_c12"  height="230" width="754"></canvas>
			</div>
		
		<!-- /.box-body -->

		<div class="row">
			{{-- <div class="col-lg-3 col-xs-6">
			</div> --}}
			<div class="col-lg-6 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-gray">
				<div class="inner">
					<h4><b>{{$circ_12->blancos}}</b></h4>
	
					<p><b>Blancos</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-circle-o"></i>
				</div>
				<br>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-6 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-gray">
				<div class="inner">
					<h4><b>{{$circ_12->nulos}}</b></h4>
	
					<p><b>Nulos</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-times-circle"></i>
				</div>
				<br>
				</div>
			</div>
			<!-- ./col -->
			</div>
		</div>
	</div>
	{{-- FIN CIRCUNSCIPCION 12 --}}
	
	{{-- INICIO CIRCUNSCIPCION 13 --}}
	<div class="box box-primary">
		<a href="javascript:void(0);" onclick="refrescar_votos();">
			<div class="box-header with-border" style="background-color:#3c8dbc; text-align:center">
				<h3 class="box-title" style="color:white">Votos Uninominales Circunscripción 13</h3>
			</div>
		</a>
		<div class="box-body" style="">
			<div class="chart">
			<canvas id="canvas_c13"  height="230" width="754"></canvas>
			</div>
		
		<!-- /.box-body -->

		<div class="row">
			{{-- <div class="col-lg-3 col-xs-6">
			</div> --}}
			<div class="col-lg-6 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-gray">
				<div class="inner">
					<h4><b>{{$circ_13->blancos}}</b></h4>
	
					<p><b>Blancos</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-circle-o"></i>
				</div>
				<br>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-6 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-gray">
				<div class="inner">
					<h4><b>{{$circ_13->nulos}}</b></h4>
	
					<p><b>Nulos</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-times-circle"></i>
				</div>
				<br>
				</div>
			</div>
			<!-- ./col -->
			</div>
		</div>
	</div>
	{{-- FIN CIRCUNSCRIPCION 13 --}}

</section>
@endsection


@section('scripts')

@parent

<script>
function activar_uninominales_c10() {
	// alertify.success('hola');
	var url = "{{url('uninominales_c10')}}";
	var Partidos = new Array();
	var Labels = new Array();
	var Votos = new Array();
	var Fill = new Array();
	var BorderColor = new Array();
	$.get(url, function(response){
	response.forEach(function(data){
		Partidos.push(data.sigla);
		Labels.push(data.id_partido);
		Votos.push(data.validos);
		Fill.push(data.fill);
		BorderColor.push(data.borderColor);
	});
	var chartData = {
		labels:Partidos,
        datasets: [
            {
				label: 'Votos',
				data: Votos,
				datalabels: {
					align: 'end',
					anchor: 'start'
				},
				borderWidth: 1,
				fill:false,
				backgroundColor:Fill,
				borderColor:BorderColor,
				borderWidth:1
            }
        ]
    };
	var opciones = {

		scales: {
			xAxes: [{
				ticks: {
					fontSize: 15,
					fontStyle: 'bold'
				}
			}],
			yAxes: [{
				ticks: {
					beginAtZero:true,
					fontSize: 15
				}
			}]
		},
		legend: {
			display: false // Ocultando el titulo del centro
		},

		// events: true,
		// tooltips: {
		// 	enabled: true
		// },
		hover: {
			animationDuration: 0
		},
		animation: {
			duration: 1,
			onComplete: function () {
				var chartInstance = this.chart,
					ctx = chartInstance.ctx;
				// ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
				ctx.font = Chart.helpers.fontString(12, 'bold', Chart.defaults.global.defaultFontFamily);
				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function (dataset, i) {
					var meta = chartInstance.controller.getDatasetMeta(i);
					meta.data.forEach(function (bar, index) {
						var data = dataset.data[index];                            
						ctx.fillText(data+' ', bar._model.x, bar._model.y +1);
					});
				});
			}
		}
	};
	var ctx = document.getElementById("canvas_c10"),
		myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: opciones
     });

	});
}

function activar_uninominales_c11() {
	// alertify.success('hola');
	var url = "{{url('uninominales_c11')}}";
	var Partidos = new Array();
	var Labels = new Array();
	var Votos = new Array();
	var Fill = new Array();
	var BorderColor = new Array();
	$.get(url, function(response){
	response.forEach(function(data){
		Partidos.push(data.sigla);
		Labels.push(data.id_partido);
		Votos.push(data.validos);
		Fill.push(data.fill);
		BorderColor.push(data.borderColor);
	});
	var chartData = {
		labels:Partidos,
        datasets: [
            {
				label: 'Votos',
				data: Votos,
				datalabels: {
					align: 'end',
					anchor: 'start'
				},
				borderWidth: 1,
				fill:false,
				backgroundColor:Fill,
				borderColor:BorderColor,
				borderWidth:1
            }
        ]
    };
	var opciones = {

		scales: {
			xAxes: [{
				ticks: {
					fontSize: 15,
					fontStyle: 'bold'
				}
			}],
			yAxes: [{
				ticks: {
					beginAtZero:true,
					fontSize: 15
				}
			}]
		},
		legend: {
			display: false // Ocultando el titulo del centro
		},

		// events: true,
		// tooltips: {
		// 	enabled: true
		// },
		hover: {
			animationDuration: 0
		},
		animation: {
			duration: 1,
			onComplete: function () {
				var chartInstance = this.chart,
					ctx = chartInstance.ctx;
				// ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
				ctx.font = Chart.helpers.fontString(12, 'bold', Chart.defaults.global.defaultFontFamily);
				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function (dataset, i) {
					var meta = chartInstance.controller.getDatasetMeta(i);
					meta.data.forEach(function (bar, index) {
						var data = dataset.data[index];                            
						ctx.fillText(data+' ', bar._model.x, bar._model.y +1);
					});
				});
			}
		}
	};
	var ctx = document.getElementById("canvas_c11"),
		myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: opciones
     });

	});
}

function activar_uninominales_c12() {
	// alertify.success('hola');
	var url = "{{url('uninominales_c12')}}";
	var Partidos = new Array();
	var Labels = new Array();
	var Votos = new Array();
	var Fill = new Array();
	var BorderColor = new Array();
	$.get(url, function(response){
	response.forEach(function(data){
		Partidos.push(data.sigla);
		Labels.push(data.id_partido);
		Votos.push(data.validos);
		Fill.push(data.fill);
		BorderColor.push(data.borderColor);
	});
	var chartData = {
		labels:Partidos,
        datasets: [
            {
				label: 'Votos',
				data: Votos,
				datalabels: {
					align: 'end',
					anchor: 'start'
				},
				borderWidth: 1,
				fill:false,
				backgroundColor:Fill,
				borderColor:BorderColor,
				borderWidth:1
            }
        ]
    };
	var opciones = {

		scales: {
			xAxes: [{
				ticks: {
					fontSize: 15,
					fontStyle: 'bold'
				}
			}],
			yAxes: [{
				ticks: {
					beginAtZero:true,
					fontSize: 15
				}
			}]
		},
		legend: {
			display: false // Ocultando el titulo del centro
		},

		// events: true,
		// tooltips: {
		// 	enabled: true
		// },
		hover: {
			animationDuration: 0
		},
		animation: {
			duration: 1,
			onComplete: function () {
				var chartInstance = this.chart,
					ctx = chartInstance.ctx;
				// ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
				ctx.font = Chart.helpers.fontString(12, 'bold', Chart.defaults.global.defaultFontFamily);
				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function (dataset, i) {
					var meta = chartInstance.controller.getDatasetMeta(i);
					meta.data.forEach(function (bar, index) {
						var data = dataset.data[index];                            
						ctx.fillText(data+' ', bar._model.x, bar._model.y +1);
					});
				});
			}
		}
	};
	var ctx = document.getElementById("canvas_c12"),
		myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: opciones
     });

	});
}

function activar_uninominales_c13() {
	// alertify.success('hola');
	var url = "{{url('uninominales_c13')}}";
	var Partidos = new Array();
	var Labels = new Array();
	var Votos = new Array();
	var Fill = new Array();
	var BorderColor = new Array();
	$.get(url, function(response){
	response.forEach(function(data){
		Partidos.push(data.sigla);
		Labels.push(data.id_partido);
		Votos.push(data.validos);
		Fill.push(data.fill);
		BorderColor.push(data.borderColor);
	});
	var chartData = {
		labels:Partidos,
        datasets: [
            {
				label: 'Votos',
				data: Votos,
				datalabels: {
					align: 'end',
					anchor: 'start'
				},
				borderWidth: 1,
				fill:false,
				backgroundColor:Fill,
				borderColor:BorderColor,
				borderWidth:1
            }
        ]
    };
	var opciones = {

		scales: {
			xAxes: [{
				ticks: {
					fontSize: 15,
					fontStyle: 'bold'
				}
			}],
			yAxes: [{
				ticks: {
					beginAtZero:true,
					fontSize: 15
				}
			}]
		},
		legend: {
			display: false // Ocultando el titulo del centro
		},

		// events: true,
		// tooltips: {
		// 	enabled: true
		// },
		hover: {
			animationDuration: 0
		},
		animation: {
			duration: 1,
			onComplete: function () {
				var chartInstance = this.chart,
					ctx = chartInstance.ctx;
				// ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
				ctx.font = Chart.helpers.fontString(12, 'bold', Chart.defaults.global.defaultFontFamily);
				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function (dataset, i) {
					var meta = chartInstance.controller.getDatasetMeta(i);
					meta.data.forEach(function (bar, index) {
						var data = dataset.data[index];                            
						ctx.fillText(data+' ', bar._model.x, bar._model.y +1);
					});
				});
			}
		}
	};
	var ctx = document.getElementById("canvas_c13"),
		myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: opciones
     });

	});
}

activar_uninominales_c10();
activar_uninominales_c11();
activar_uninominales_c12();
activar_uninominales_c13();


// window.setInterval(function(){
// 	location.reload();
// }, 5000);

function refrescar_votos(){
	location.reload();
}

</script>

@endsection


