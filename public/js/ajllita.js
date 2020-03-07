$(document).ready(function(){

  if (document.getElementById("clock")) {
    
    var countDownDate = new Date("Oct 20, 2019 00:00:01").getTime();

    /* Update the count down every 1 second */
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="clock"
      document.getElementById("clock").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s Restantes";

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("clock").innerHTML = "Día decisivo";
      }
    }, 1000);
  }

  $("#id_origen").change(function(){
    cargaSubOrigen();
  });

  function cargaSubOrigen(){
    $(".sub_origen_json select").html("");
    var id_origen = $("#id_origen").val();
  
    // console.log($("#anio").val());
    $.getJSON("consultaSubOrigen/"+id_origen+"",{},function(objetosretorna){
        $("#error").html("");
        var TamanoArray = objetosretorna.length;
        $(".sub_origen_json select").append('<option value="0"> --- SELECCIONE EL SUB ORIGEN --- </option>');
        $.each(objetosretorna, function(i,value){
            $(".sub_origen_json select").append('<option value="'+value.id_sub_origen+'">'+value.nombre+'</option>');
        });
    });
  };
  
  $("#id_circunscripcion").change(function(){
    cargaDistritos();
  });

  $("#id_distrito").change(function(){
    cargaRecintos();
  });

  $("#id_origen").change(function(){
    //alert("hola");
    cargaSuborigen();
  });

function cargaDistritos(){
  $(".distrito_json select").html("");
  var id_circunscripcion = $("#id_circunscripcion").val();

  $.getJSON("consultaDistritos/"+id_circunscripcion+"",{},function(objetosretorna){
      $("#error").html("");
      var TamanoArray = objetosretorna.length;
      $(".distrito_json select").append('<option value="0"> --- SELECCIONE EL DISTRITO --- </option>');
      $.each(objetosretorna, function(i,value){
          $(".distrito_json select").append('<option value="'+value.distrito+'">'+value.distrito+'</option>');
      });
  });
};

function cargaRecintos(){
  $(".recinto_json select").html("");
  var id_circunscripcion = $("#id_circunscripcion").val();
  var id_distrito = $("#id_distrito").val();

  $.getJSON("consultaRecintos/"+id_distrito+"/"+id_circunscripcion+"",{},function(objetosretorna){
      $("#error").html("");
      var TamanoArray = objetosretorna.length;
      $(".recinto_json select").append('<option value="0"> --- SELECCIONE EL RECINTO --- </option>');
      $.each(objetosretorna, function(i,value){
          $(".recinto_json select").append('<option value="'+value.id_recinto+'">'+value.id_recinto+' - '+value.nombre+'</option>');
      });
  });
};

function cargaSuborigen(){
  $(".suborigen_json select").html("");
  var id_origen = $("#id_origen").val();

  $.getJSON("consultaSuborigen/"+id_origen+"",{},function(objetosretorna){
      $("#error").html("");
      var TamanoArray = objetosretorna.length;
      $(".suborigen_json select").append('<option value="0"> SELECCIONE LA SUB ORGANIZACION </option>');
      $.each(objetosretorna, function(i,value){
          $(".suborigen_json select").append('<option value="'+value.id_sub_origen+'">'+value.nombre+'</option>');
      });
  });
};

//
$('#btn_vaciar').click(function(){
  var div_resul="div_notificacion_sol";
  $.ajax({
    type: "POST",
    url: "truncate",
    data: {},
    success: function(resul)
    {
        if (resul == 'ok') {
          alertify.success('listo Bro!');
        }
    },
    error : function(xhr, status) {
        $("#"+div_resul+"").html('ha ocurrido un error al agregar el usuario, revise su conexion e intentelo nuevamente');
    }
  });
});

  $('#btn_habilitar').click(function(){
    var div_resul="div_notificacion_sol";
    $.ajax({
      type: "POST",
      url: "habilitar_encuesta",
      data: {},
      success: function(resul)
      {
          if (resul == 'ok') {
            alertify.success('Encuestas Habilitadas');
          }
      },
      error : function(xhr, status) {
          $("#"+div_resul+"").html('ha ocurrido un error al agregar el usuario, revise su conexion e intentelo nuevamente');
      }
    });
  });

  $('#btn_inhabilitar').click(function(){
    var div_resul="div_notificacion_sol";
    $.ajax({
      type: "POST",
      url: "inhabilitar_encuesta",
      data: {},
      success: function(resul)
      {
          if (resul == 'ok') {
            alertify.success('Encuestas Deshabilitadas');
          }
      },
      error : function(xhr, status) {
          $("#"+div_resul+"").html('ha ocurrido un error al agregar el usuario, revise su conexion e intentelo nuevamente');
      }
    });
  });

  $('#btn_plus_tres_v').click(function(){
    //$('#btn-cancelar_suspension').attr("disabled", true);//desabilitando despues del click
    var div_resul="div_notificacion_sol";
      $.ajax({
      type:'POST',
      url:"enviar_tres_v",
      data:{'numero':3},
        success: function(result){
            if (result == 'ok') {
              // refrescar();
              alertify.success('3 visitantes agregados');
            }
            else{
              $("#"+div_resul+"").html(result);
            }
          }
      })
    });

    $('#btn_plus_cinco_v').click(function(){
      //$('#btn-cancelar_suspension').attr("disabled", true);//desabilitando despues del click
      var div_resul="div_notificacion_sol";
        $.ajax({
        type:'POST',
        url:"enviar_diez_v",
        data:{'numero':5},
          success: function(result){
              if (result == 'ok') {
                // refrescar();
                alertify.success('5 visitantes agregados');
              }
              else{
                $("#"+div_resul+"").html(result);
              }
            }
        })
      });
      $('#btn_plus_diez_v').click(function(){
        //$('#btn-cancelar_suspension').attr("disabled", true);//desabilitando despues del click
        var div_resul="div_notificacion_sol";
          $.ajax({
          type:'POST',
          url:"enviar_diez_v",
          data:{'numero':10},
            success: function(result){
                if (result == 'ok') {
                  // refrescar();
                  alertify.success('10 visitantes agregados');
                }
                else{
                  $("#"+div_resul+"").html(result);
                }
              }
          })
        });

        $('#btn_plus_tres_m').click(function(){
          //$('#btn-cancelar_suspension').attr("disabled", true);//desabilitando despues del click
          var div_resul="div_notificacion_sol";
            $.ajax({
            type:'POST',
            url:"enviar_tres_m",
            data:{'numero':3},
              success: function(result){
                  if (result == 'ok') {
                    // refrescar();
                    alertify.success('3 visitantes agregados');
                  }
                  else{
                    $("#"+div_resul+"").html(result);
                  }
                }
            })
          });

          $('#btn_plus_cinco_m').click(function(){
            //$('#btn-cancelar_suspension').attr("disabled", true);//desabilitando despues del click
            var div_resul="div_notificacion_sol";
              $.ajax({
              type:'POST',
              url:"enviar_diez_m",
              data:{'numero':5},
                success: function(result){
                    if (result == 'ok') {
                      // refrescar();
                      alertify.success('5 visitantes agregados');
                    }
                    else{
                      $("#"+div_resul+"").html(result);
                    }
                  }
              })
            });
            $('#btn_plus_diez_m').click(function(){
              //$('#btn-cancelar_suspension').attr("disabled", true);//desabilitando despues del click
              var div_resul="div_notificacion_sol";
                $.ajax({
                type:'POST',
                url:"enviar_diez_m",
                data:{'numero':10},
                  success: function(result){
                      if (result == 'ok') {
                        // refrescar();
                        alertify.success('10 visitantes agregados');
                      }
                      else{
                        $("#"+div_resul+"").html(result);
                      }
                    }
                })
              });


  var Eventos_iniciales = {

    url: 'calendario_feriados',
    type: 'GET', // Send post data
    error: function() {
        alert('No se encontró ninguna fecha.');
    }
  };
  $('#calendario_feriados').fullCalendar({
      header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,listYear'
      },
      // allDay : false,
      aspectRatio: 1,
      weekends: false,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      eventTextColor: 'Black',

      eventRender: function(event, element) {
          element.bind('dblclick', function() {
              $('#btn_borrar_feriado').attr("disabled", false);
              $('#ModalEdit #id').val(event.id);
              $('#ModalEdit #title').val(event.title);
              $('#ModalEdit #color').val(event.color);
              $('#ModalEdit').modal('show');
              $('#desc_feriado').val(event.title);
          });
      },
      dayClick: function(date) {
        $('#ModalAdd #start').val(moment(date).format('YYYY-MM-DD'));
        $('#ModalAdd #end').val(moment(date).format('YYYY-MM-DD'));
        $('#ModalAdd').modal('show');
      },
      events: Eventos_iniciales,
      eventOverlap: false,
      // eventRender: false
  });

  $('#btn_borrar_feriado').click(function(){
    $('#ModalEdit').modal('hide');
  });


  $('#btn-pdf').hide()
  $('#btn-cancelar').hide()
  //REPORTES
  $("#id_min").change(function(){
    cargaDirecciones();
    cargaUnidades();
  });

  $("#id_dir").change(function(){
    cargaUnidades();
  });

  $("#id_uni").change(function(){
    cargaRanking();
  });

  function cargaRanking(){
    $("#tabla_ranking tbody").html("");
      // $("#error").html("<div class='modal1'><div class='center1'> <center> <img src='img/gif-load.gif'> Buscando Informacion...</center></div></div>");
    var id_min = $("#id_min").val();
    var id_dir = $("#id_dir").val();
    var id_uni = $("#id_uni").val();

    $.getJSON("ranking_vacaciones",{id_min:id_min, id_dir:id_dir, id_uni:id_uni},function(objetosretorna){
      $("#error").html("");
      var TamanoArray = objetosretorna.length;
      $.each(objetosretorna, function(i,datos){

        var nuevaFila =
        "<tr>"
        +"<td>"+datos.unidad+"</td>"
        +"<td>"+datos.nombre+" "+datos.paterno+" "+datos.materno+"</td>"
        +"<td>"+datos.fechaingreso+"</td>"
        +"<td>"+datos.item+"</td>"
        +"<td>"+parseInt(datos.desde.substr(0,4))+" - "+parseInt(datos.hasta.substr(0,4))+"</td>"
        +"<td>"+datos.vigencia+"</td>"
        +"<td>"+(datos.dias+datos.total_saldo)+"</td>"
        +"<td>"+datos.dias+"</td>"
        +"<td>"+datos.total_saldo+"</td>"
        +"</tr>";

        $(nuevaFila).appendTo("#tabla_ranking tbody");
      });
      if(TamanoArray==0){
        var nuevaFila =
        "<tr><td colspan=6>No se encontraron parametros para su busqueda</td>"
        +"</tr>";
        $(nuevaFila).appendTo("#tabla_ranking tbody");
      }
    });
  };

  function cargaDirecciones(){
    $(".dir_json select").html("");
    var id_min = $("#id_min").val();

    // console.log($("#anio").val());
    $.getJSON("consultaDirecciones/"+id_min+"",{},function(objetosretorna){
      $("#error").html("");
      var TamanoArray = objetosretorna.length;
      $(".dir_json select").append('<option value="0"> --- SELECCIONE UNA DIRECCION --- </option>');
      $.each(objetosretorna, function(i,value){
        $(".dir_json select").append('<option value="'+value.id_dir+'">'+value.nombre_dir+'</option>');
      });
    });
  };

  function cargaUnidades(){
    $(".uni_json select").html("");
    var id_dir = $("#id_dir").val();

    // console.log($("#anio").val());
    $.getJSON("consultaUnidades/"+id_dir+"",{},function(objetosretorna){
      $("#error").html("");
      var TamanoArray = objetosretorna.length;
      $(".uni_json select").append('<option value="0"> --- SELECCIONE UNA UNIDAD --- </option>');
      $.each(objetosretorna, function(i,value){
        $(".uni_json select").append('<option value="'+value.id_unidad+'">'+value.nombre_unidad+'</option>');
      });
    });
  };

  //CALENDARIO
  $("#tablajson tbody").html("");
  $("#div_calendar").hide()

  $('#btn-calendar').click(function(){
    $("#div_calendar").show();
    $('#btn-pdf').show()
    $('#btn-cancelar').show()
    limpiar();
    var id_sol = $("#id_solicitud").val();
    calendario();

    $("#btn-calendar").hide();
  });


  $('#btn_guarda_fecha').click(function(){
    // $('#btn_guarda_fecha').attr("disabled", true);
  });

  $('#btn-pdf').click(function(){
      id_sol = $("#id_solicitud").val()
      $.ajax({
        type:'get',
        url:"agregar_solicitud",
        data:{'id_sol':id_sol},
        success: function(result){
          if (result == 'error') {
            alert("No se pudo realizar la petición");
          }
          else if(result == 'vacio'){
            alert('No seleccionó ninguna fecha..!');
          }
          else if(result == 'ok'){
          recargar();
          // alert($("#id_solicitud").val());
          }
          else
          {
            alert("Ocurrió un error, revise su conexión");
          }
        }
    });
  });

  // $('#id_buscar_asignacion').click(function(){
    
  //   var div_resul="div_notificacion_sol";
  //   var dato_buscado = $("#dato_buscado").val();
    
  //   $.ajax({
  //     type:'POST',
  //     url:"buscar_persona_asignacion", // sending the request to the same page we're on right now
  //     data:{'dato_buscado':dato_buscado},
  //        success: function(result){
  //             if (result == 'ok') {
  //               alertify.success('uhhh '+dato_buscado);
  //               // refrescar();
  //             }
  //             else{
  //               alertify.success('uhhh '+dato_buscado);
  //               $("#"+div_resul+"").html(result);
  //             }
  //         }
  //     }
  // )

  // });


    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var f=new Date();
    // document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
    $("#hoy").text(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());

});

function refrescar(){
  timout=setTimeout(function(){
      location.reload();
  },3000,"JavaScript");//3 segundos
}
function recargar(){
  timout=setTimeout(function(){
      location.reload();
  },0,"JavaScript");//3 segundos
}

function refresh_calendar(){
  $('#btn_guarda_fecha').attr("disabled", false);
  var events = {
      url: 'calendar_datos',
      type: 'GET', // Send post data
      error: function() {
          alert('No se encontró ninguna fecha.');
      }
  };
//   var events;
//   $.ajax({
//   type:'get',
//   url:"calendar_datos",
//   success: function(result){
//       if (result == 'error') {
//       alert("No se pudo realizar la petición");
//       }
//       else if(result == 'ok'){
//           alert("ok petición");
//       }
//       else{
//           defaultEvents = result;
//       }
//   }
// });

  $('#calendar').fullCalendar('removeEventSource', events);
  $('#calendar').fullCalendar('addEventSource', events);
  $('#calendar').fullCalendar('refetchEvents');
}

function refresh_calendar_feriado(){
  $('#btn_guarda_fecha').attr("disabled", false);
  var events = {
      url: 'calendario_feriados',
      type: 'GET', // Send post data
      error: function() {
          alert('No se encontró ninguna fecha.');
      }
  };

  $('#calendario_feriados').fullCalendar('removeEventSource', events);
  $('#calendario_feriados').fullCalendar('addEventSource', events);
  $('#calendario_feriados').fullCalendar('refetchEvents');
}

function refresh_calendar_emergencias(id_sol){
  var events = {
      url: 'calendar_datos_emergencias/'+id_sol,
      type: 'GET', // Send post data
      error: function() {
          alert('No se encontró ninguna fecha.');
      }
  };

  $('#calendar_emergencias').fullCalendar('removeEventSource', events);
  $('#calendar_emergencias').fullCalendar('addEventSource', events);
  $('#calendar_emergencias').fullCalendar('refetchEvents');
}

function aceptar_suspension_rr_hh(id_suspension){
  var div_resul="div_notificacion_sol";
  $.ajax({
    type:'POST',
    url:"aceptar_suspension_rr_hh", // sending the request to the same page we're on right now
    data:{'id_suspension':id_suspension},
       success: function(result){
            if (result == 'ok') {
              location.reload()
              // refrescar();
              // $('#div-suspension').load(location.href);
            }
            else{
              $(div_resul).html(result);
            }
        }
    })
}

function aceptar_suspension_unidad(id_suspension){
  var div_resul="div_notificacion_sol";
  $.ajax({
    type:'POST',
    url:"aceptar_suspension_unidad", // sending the request to the same page we're on right now
    data:{'id_suspension':id_suspension},
       success: function(result){
            if (result == 'ok') {
              location.reload()
              // refrescar();
              // $('#div-suspension').load(location.href);
            }
            else{
              $(div_resul).html(result);
            }
        }
    })
}

function estado_calendario(arg){//get con Json
  $("#tablajson tbody").html("");
  $.getJSON("estado_calendario/"+arg+"",{},function(objetosretorna){
    // alert(objetosretorna);
    $("#error").html("");
    var TamanoArray = objetosretorna.length;
    var solicitados = 0;
    var saldo = 0;
    var indice = 0;
    var disponible = 0;
    if(TamanoArray > 0){
      disponible = parseFloat(objetosretorna[0].disponible);
    }

    $("#total_solicitud").text(solicitados);
    $("#total_saldo").text(saldo);
    $("#total_disponible").text(disponible);
    $.each(objetosretorna, function(i,items){

      solicitados = solicitados + parseFloat(items.usadas);
      // disponible = (parseFloat(items.disponible) - total);
      saldo = (parseFloat(disponible - solicitados));
      indice ++;
      var nuevaFila =
    "<tr>"
    +"<td>"+indice+"</td>"
    +"<td>"+formato(items.start)+"</td>"
    +"<td>"+items.title+"</td>"
    +"</tr>";

      $(nuevaFila).appendTo("#tablajson tbody");
    });

    $("#total_solicitud").text(solicitados);
    $("#total_saldo").text(saldo);
    if(TamanoArray==0){
      var nuevaFila =
      "<tr><td colspan=6>Seleccione un día</td>"
      +"</tr>";
      $(nuevaFila).appendTo("#tablajson tbody");
    }
  });
}

function formato(fecha){
  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}

function limpiar(){
  // var id = $id_sol;
 $('#btn-calendar').attr("disabled", true);
  $.ajax({
      type:'get',
      url:"crear_sol",
      // data:{'id_sol':id},
      success: function(result){
        if (result == 'error') {
          alert("No se pudo realizar la petición");
        }
        else{
          $("#span_solicitud").text('Formulario de Solicitud No. '+result);
          estado_calendario(result);
          $("#id_solicitud").val(result);
          $("#id_solicitud_edit").val(result);
          // alert($("#id_solicitud").val());
        }
      }
  });
}

function  sol_vacaciones(arg){
	var urlraiz=$("#url_raiz_proyecto").val();
	var miurl =urlraiz+"/form_sol_vacacion/"+arg+"";
	$("#capa_modal").show();
	$("#capa_formularios").show();
	var screenTop = $(document).scrollTop();
	$("#capa_formularios").css('top', screenTop);
  $("#capa_formularios").html($("#cargador_empresa").html());

    $.ajax({
    url: miurl
    }).done( function(resul)
    {
     $("#capa_formularios").html(resul);
    }).fail( function()
   {
    $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;
}


function  liberar_responsabilidad(id_persona){
  var div_resul="div_notificacion_sol";
  
  $.ajax({
    type:'POST',
    url:"liberar_responsabilidad", // sending the request to the same page we're on right now
    data:{'id_persona':id_persona},
       success: function(result){
            if (result == 'ok') {
              location.reload()
            }
            else{
              alertify.success('resultado:'+result);
            }
        }
    }).done( function(resul) 
      {
       $("#capa_formularios").html(resul);
     
      }).fail( function() 
     {
      $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
     }) ;
  }

function verinfo_persona(id, form){
  var urlraiz=$("#url_raiz_proyecto").val();
  if(form == 1){var miurl =urlraiz+"/form_editar_persona/"+id+""; }
  if(form == 2){var miurl =urlraiz+"/form_baja_persona/"+id+""; }

  if(form == 31){var miurl = urlraiz+"/form_mesas_recinto";}

  if (form == 30) {

    alertify.success('id_persona:'+id_persona);
    $.ajax({
      type:'POST',
      url:"liberar_responsabilidad", // sending the request to the same page we're on right now
      data:{'id_persona':id_persona},
         success: function(result){
              if (result == 'ok') {
                location.reload()
              }
              else{
                $(div_resul).html(result);
              }
          }
      })
  }
 
	$("#capa_modal").show();
	$("#capa_formularios").show();
	var screenTop = $(document).scrollTop();
	$("#capa_formularios").css('top', screenTop);
  $("#capa_formularios").html($("#cargador_empresa").html());

    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
     $("#capa_formularios").html(resul);
   
    }).fail( function() 
   {
    $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;
}

function  verinfo_usuario(id, form){
  var urlraiz=$("#url_raiz_proyecto").val();
  if(form == 1){var miurl =urlraiz+"/form_editar_usuario/"+id+""; }

  if(form == 20){var miurl =urlraiz+"/form_asignar_usuario_mesa/"+id+""; }

  if(form == 4){var miurl =urlraiz+"/form_editar_gestion/"+id+""; }
  if(form == 7){var miurl =urlraiz+"/form_sol_vacacion_unidad/"+id+""; }
  if(form == 8){var miurl =urlraiz+"/form_sol_vacacion_rr_hh/"+id+""; }
  if(form == 9){var miurl =urlraiz+"/form_sol_suspension_usuario/"+id+""; }
  if(form == 10){var miurl =urlraiz+"/form_sol_suspension_unidad/"+id+""; }
  if(form == 11){var miurl =urlraiz+"/form_sol_suspension_rr_hh/"+id+""; }
  if(form == 12){var miurl =urlraiz+"/form_anulacion_vacacion/"+id+""; }
  if(form == 13){var miurl =urlraiz+"/form_sol_emergencias_usuario/"+id+""; }

 

	$("#capa_modal").show();
	$("#capa_formularios").show();
	var screenTop = $(document).scrollTop();
	$("#capa_formularios").css('top', screenTop);
  $("#capa_formularios").html($("#cargador_empresa").html());

    $.ajax({
    url: miurl
    }).done( function(resul)
    {
     $("#capa_formularios").html(resul);

    }).fail( function()
   {
    $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;
}

function  verinfo_mesas(id, form){
  var urlraiz=$("#url_raiz_proyecto").val();
  if(form == 1){var miurl =urlraiz+"/detalle_presidenciales_mesa/"+id+""; }
  if(form == 2){var miurl =urlraiz+"/detalle_uninominales_mesa/"+id+""; }

  if(form == 10){var miurl =urlraiz+"/form_llenado_emergencia/"+id+""; }
  if(form == 11){var miurl =urlraiz+"/form_llenado_emergencia_uninominales/"+id+""; }

  if(form == 20){var miurl =urlraiz+"/form_votar_presidencial_subir_imagen_popup/"+id+""; }
  if(form == 21){var miurl =urlraiz+"/form_votar_uninominal_subir_imagen_popup/"+id+""; }

	$("#capa_modal").show();
	$("#capa_formularios").show();
	var screenTop = $(document).scrollTop();
	$("#capa_formularios").css('top', screenTop);
  $("#capa_formularios").html($("#cargador_empresa").html());

    $.ajax({
    url: miurl
    }).done( function(resul)
    {
     $("#capa_formularios").html(resul);

    }).fail( function()
   {
    $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;
}

$(document).on("click",".div_modal", function(e){
	$(this).hide();
	$("#capa_formularios").hide();
	$("#capa_formularios").html("");
})

$(document).on("click","#cerrar_modal", function(e){
  $("#capa_modal").hide();
  $("#capa_formularios").hide();
})

document.onkeydown = function(evt) {
  evt = evt || window.event;
  if (evt.keyCode == 27) {
    $("#capa_modal").hide();
    $("#capa_formularios").hide();
  }
};

function cargar_formulario(arg){
   var urlraiz=$("#url_raiz_proyecto").val();
   $("#capa_modal").show();
   $("#capa_formularios").show();
   var screenTop = $(document).scrollTop();
   $("#capa_formularios").css('top', screenTop);
   $("#capa_formularios").html($("#cargador_empresa").html());
   if(arg==1){ var miurl=urlraiz+"/form_nuevo_usuario"; }
   if(arg==2){ var miurl=urlraiz+"/form_nuevo_rol"; }
   if(arg==3){ var miurl=urlraiz+"/form_nuevo_permiso"; }
   if(arg==4){ var miurl=urlraiz+"/form_nueva_gestion"; }

   if(arg==20){ var miurl=urlraiz+"/form_asignar_usuario_mesa"; }

    $.ajax({
    url: miurl
    }).done( function(resul)
    {
     $("#capa_formularios").html(resul);

    }).fail( function()
   {
    $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;

}

$(document).on("submit",".formentrada",function(e){

  var id_sol = $("#id_solicitud").val();
  e.preventDefault();
  $('#btn_guarda_fecha').attr("disabled", true);
  $('#ModalAdd').modal('hide');
  $('#ModalEdit').modal('hide');

  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";

  if(quien=="f_asignar_mesas_recinto"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_asignar_usuario_mesa"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_enviar_agregar_persona"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_enviar_editar_persona"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_baja_persona"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}

  if(quien=="f_enviar_gastronomia"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_enviar_visitante"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_enviar_literatura"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_enviar_turismo"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_enviar_productores"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_enviar_artesania"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}


  if(quien=="f_editar_solicitud"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_editar_gestion"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";}
  if(quien=="f_crear_gestion"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";}
  if(quien=="f_editar_tiempo"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_agregar_fechas"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_modal";  }
  if(quien=="f_autorizar_solicitud"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_aprobar_solicitud"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_crear_solicitud"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";  }
  if(quien=="f_crear_usuario"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_crear_permiso"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_editar_usuario"){  var varurl=$(this).attr("action");  var div_resul="notificacion_E2";  }
  if(quien=="f_editar_acceso"){  var varurl=$(this).attr("action");  var div_resul="notificacion_E3";  }
  if(quien=="f_borrar_usuario"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_asignar_permiso"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_agregar_feriado"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";}
  if(quien=="f_editar_feriado"){  var varurl=$(this).attr("action");  var div_resul="div_notificacion_sol";  }

  // $("#"+div_resul+"").html( $("#cargador_empresa").html());

  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    type : 'POST',
    dataType : 'html',

    success : function(resul) {
      
      if(quien=="f_baja_persona"){
        if (resul == 'ok') {
          recargar();
        }
        else if(resul == 'failed'){
          $("#"+div_resul+"").html('ha ocurrido un error, revise su conexion e intentelo nuevamente');
        }
      }else if(quien=="f_enviar_agregar_persona" || quien=="f_enviar_editar_persona"){
        if (resul == 'failed') {
          alertify.success('Ocurrió un error, revise su conexión');
        }else if(resul == 'apellido'){
          alertify.error('Debe ingresar al menos un apellido');
        }else if(resul == 'cedula_repetida'){
          alertify.error('El número de Carnet ya se encuentra registrado!');
        }else if(resul == 'rol'){
        alertify.error('Seleccione una Tarea');
        }else if(resul == 'recinto'){
          alertify.error('Seleccione Circ. Distrito y Recinto');
        }else if(resul == 'id_vehiculo'){
          alertify.error('Seleccione un vehículo');
        }else if(resul == 'id_casa_campana'){
          alertify.error('Seleccione su Casa de Campaña');
        }else if(resul == 'mesas'){
          alertify.error('Seleccione las Mesas');
        }else if(resul == 'distrito'){
          alertify.error('Seleccione un Distrito');
        }else if(resul == 'circunscripcion'){
          alertify.error('Seleccione la Circunscripcion');
        }else{
          $("#"+div_resul+"").html(resul);
        }

      }else if(quien=="f_asignar_usuario_mesa" && resul == 'ok'){
        recargar();
      }else if(quien=="f_asignar_usuario_mesa" && resul != 'ok'){
        alertify.success(resul);
      }else if(quien=="f_editar_tiempo" && resul == 'ok'){
        $('#ModalEdit').modal('hide');
        refresh_calendar();
        refresh_calendar_emergencias(id_sol);
        estado_calendario(id_sol);
        $('#btn_edita_fecha').attr("disabled", false);
      }else if(quien=="f_editar_tiempo" && resul == 'diferente'){
        alertify.success('No puede editar otras solicitudes');
      }
      else if(quien=="f_editar_solicitud" && resul == 'ok'){

        refresh_calendar(id_sol);
        // estado_calendario(id_sol);
      }
      else if(quien=="f_agregar_feriado" && resul == 'ok'){
        refresh_calendar_feriado();
      }
      else if(quien=="f_editar_feriado" && resul == 'ok'){
        refresh_calendar_feriado();
      }
      else{
        // $('#capa_modal').modal('hide');
        $("#"+div_resul+"").html(resul);
      }

       },
    error : function(xhr, status) {
          $("#"+div_resul+"").html('ha ocurrido un error, revise su conexion e intentelo nuevamente');
    }
  });
})

$(document).on("submit",".form_crear_rol",function(e){
  e.preventDefault();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl=$(this).attr("action");

   $("#div_notificacion_rol").html( $("#cargador_empresa").html());
   $(".form-group").removeClass("has-error");
   $(".help-block").text('');

  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    type : 'POST',
    dataType : "html",

    success : function(resul) {
      $("#capa_formularios").html(resul);
    },
    error : function(data) {
              var lb="";
              var errors = $.parseJSON(data.responseText);
               $.each(errors, function (key, value) {

                   $("#"+key+"_group").addClass( "has-error" );
                   $("#"+key+"_span").text(value);
               });

           $("#div_notificacion_rol").html('');
    }

  });
})

function asignar_rol(idusu){
   var idrol=$("#rol1").val();
   var urlraiz=$("#url_raiz_proyecto").val();
   $("#zona_etiquetas_roles").html($("#cargador_empresa").html());
   var miurl=urlraiz+"/asignar_rol/"+idusu+"/"+idrol+"";

    $.ajax({
    url: miurl
    }).done( function(resul)
    {
      var etiquetas="";
      var roles=$.parseJSON(resul);
      $.each(roles,function(index, value) {
        etiquetas+= '<span class="label label-warning">'+value+'</span> ';
      })

     $("#zona_etiquetas_roles").html(etiquetas);

    }).fail( function()
    {
    $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles o revise su conexion...</span>');
    }) ;

}

function quitar_rol(idusu){
   var idrol=$("#rol2").val();
   var urlraiz=$("#url_raiz_proyecto").val();
   $("#zona_etiquetas_roles").html($("#cargador_empresa").html());
   var miurl=urlraiz+"/quitar_rol/"+idusu+"/"+idrol+"";

    $.ajax({
    url: miurl
    }).done( function(resul)
    {
      var etiquetas="";
      var roles=$.parseJSON(resul);
      $.each(roles,function(index, value) {
        etiquetas+= '<span class="label label-warning" style="margin-left:10px;" >'+value+'</span> ';
      })

     $("#zona_etiquetas_roles").html(etiquetas);

    }).fail( function()
    {
    $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles  o revise su conexion...</span>');
    }) ;
}

function borrado_usuario(idusu){

   var urlraiz=$("#url_raiz_proyecto").val();
   $("#capa_modal").show();
   $("#capa_formularios").show();
   var screenTop = $(document).scrollTop();
   $("#capa_formularios").css('top', screenTop);
   $("#capa_formularios").html($("#cargador_empresa").html());
   var miurl=urlraiz+"/form_borrado_usuario/"+idusu+"";

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


function borrar_permiso(idrol,idper){

     var urlraiz=$("#url_raiz_proyecto").val();
     var miurl=urlraiz+"/quitar_permiso/"+idrol+"/"+idper+"";
     $("#filaP_"+idper+"").html($("#cargador_empresa").html() );
        $.ajax({
    url: miurl
    }).done( function(resul)
    {
     $("#filaP_"+idper+"").hide();

    }).fail( function()
   {
     alert("No se borro correctamente, intentalo nuevamente o revisa tu conexion");
   }) ;



}


function borrar_rol(idrol){

     var urlraiz=$("#url_raiz_proyecto").val();
     var miurl=urlraiz+"/borrar_rol/"+idrol+"";
     $("#filaR_"+idrol+"").html($("#cargador_empresa").html() );
        $.ajax({
    url: miurl
    }).done( function(resul)
    {
     $("#filaR_"+idrol+"").hide();

    }).fail( function()
   {
     alert("No se borro correctamente, intentalo nuevamente o revisa tu conexion");
   }) ;



}

//Funcion para cargar un archivo
$(document).on("submit",".formarchivo",function(e){

  e.preventDefault();
  var formu=$(this);
  var nombreform=$(this).attr("id");

  if(nombreform=="f_editar_evidencia_persona" ){ var miurl="editar_evidencia_persona";  var divresul="div_notificacion_sol"; }
  // if(nombreform=="f_cargar_datos_usuarios" ){ var miurl="cargar_datos_usuarios";  var divresul="notificacion_resul_fcdu"; }
  // if(nombreform=="f_subir_imagen_tipodisp" ){ var miurl="subir_imagen_tipodisp";  var divresul="notificacion_resul_fsitd"; }

  //información del formulario
  var formData = new FormData($("#"+nombreform+"")[0]);

  //hacemos la petición ajax
  $.ajax({
      url: miurl,
      type: 'POST',

      // Form data
      //datos del formulario
      data: formData,
      //necesario para subir archivos via ajax
      cache: false,
      contentType: false,
      processData: false,
      //mientras enviamos el archivo
      beforeSend: function(){
          $("#"+divresul+"").html($("#cargador_empresa").html());
      },
      //una vez finalizado correctamente
      success: function(data){
          $("#"+divresul+"").html(data);
          // $("#fotografia_usuario").attr('src', $("#fotografia_usuario").attr('src') + '?' + Math.random() );
      },
      //si ha ocurrido un error
      error: function(data){
          alert("ha ocurrido un error") ;

      }
  });
});
