$(document).ready(function() {
    

});

function calendario(){
    
    var defaultEvents = {
        url: 'calendar_datos',
        type: 'GET', // Send post data
        error: function() {
            alert('No se encontró ninguna fecha.');
        }
    };

    // var defaultEvents;
    //     $.ajax({
    //     type:'get',
    //     url:"calendar_datos",
    //     success: function(result){
    //         if (result == 'error') {
    //         alert("No se pudo realizar la petición");
    //         }
    //         else if(result == 'ok'){
    //             alert("ok petición");
    //         }
    //         else{
    //             defaultEvents = result;
    //         }
    //     }
    // });
    
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listYear'
        },
        // defaultDate: '2016-01-12',
        // allDay : false,
        aspectRatio: 1,
        weekends: false,
        // editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        eventTextColor: 'Black',
        dayClick: function(date) {
            
            var feriados =  new Array(); 
            var mostrar = false;

            $('#calendar').fullCalendar('clientEvents', function(event) {
                if (event.feriado) {
                    feriados.push (moment(event.start).format('YYYY-MM-DD'));
                }
            });
            
            if (feriados.indexOf(moment(date).format('YYYY-MM-DD')) >= 0) {
                alertify.success('No puede tomar vacaciones en Feriado!');
                // alert(moment(date).format('YYYY-MM-DD')+' - '+feriados[i]);
            }
            else{
                $('#ModalAdd #start').val(moment(date).format('YYYY-MM-DD'));
                $('#ModalAdd #end').val(moment(date).format('YYYY-MM-DD'));
                $('#ModalAdd').modal('show');
            }
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                if(event.feriado){
                    alert('feriado');
                }
                else{
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                }
            });
            // element.bind('click', function ()
            // {
            //     alert('Clicked !');
            // });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position
            edit(event);
        },
        // eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
        //     edit(event);
        // },  
        eventOverlap: function(stillEvent, movingEvent) {
            return stillEvent.allDay && movingEvent.allDay;
        },
        events: defaultEvents,
        eventOverlap: false,
        // eventRender: false   
        
    });
    
    function edit(event){
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if(event.end){
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        }else{
            end = start;
        }
        id =  event.id;
        Event = [];
        Event[0] = id;
        Event[1] = start;
        Event[2] = end;
        
        $.ajax({
         url: 'editar_fecha',
         type: "POST",
         data: {Event:Event},
         success: function(rep) {
                if(rep == 'ok'){
                    // alert(rep);
                    var id_sol = $("#id_solicitud").val();
                    // estado_calendario(id_sol);
                }else{
                    alert('No se pudo guardar, intente de nuevo.'); 
                }
            }
        });
    }
}