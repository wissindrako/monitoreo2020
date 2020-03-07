  // ( function ( $ ) {

  //   var charts = {
  //     init: function () {
  //       // -- Set new default font family and font color to mimic Bootstrap's default styling
  //       // Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  //       // Chart.defaults.global.defaultFontColor = '#292b2c';
  
  //       this.ajaxGetPostMonthlyData();
  
  //     },
  
  //     ajaxGetPostMonthlyData: function () {
  //       // var urlPath =  'plato_favorito';
  //       // var urlPath =  'plato_mas_vendido';
  //       var urlPath =  'asistencia';
  //       var request = $.ajax({
  //         dataType: "json",
  //         method: 'GET',
  //         url: urlPath
  //     });
  
  //       request.done( function ( response ) {
  //         charts.createCompletedJobsChart( response );
  //       });
  //     },
  
  //     /**
  //      * Created the Completed Jobs Chart
  //      */
  //     createCompletedJobsChart: function ( response ) {
      
  //       var label = $.map( response, function( obj, i ) { return obj.label; } );
  //       var color = $.map( response, function( obj, i ) { return obj.color; } );
  //       var value = $.map( response, function( obj, i ) { return obj.value; } );
  
  //       var ctx = document.getElementById("pieChart");
  //       var myLineChart = new Chart(ctx, {
  //         type: 'pie',
  //         data: {
  //           labels: label, // The response got from the ajax request containing all month names in the database
  //           datasets: [{
  //             label: [],
  //             backgroundColor: '#fff',
  //             backgroundColor : [
  //               "#E91E63",
  //               "#29B6F6"
  //           ],
  //           borderColor : [
  //               "#CDA776",
  //               "#989898",
  //               "#CB252B",
  //               "#E39371",
  //               "#1D7A46"
  //           ],
  //           borderWidth : 2,
  //           borderColor : '#fff',
  //             data: value// The response got from the ajax request containing data for the completed jobs in the corresponding months
  //           }],
  //         },
  //         options: {
  //           title: {
  //             display: true,
  //             text: 'Porcentaje %'
  //           },
  //           //Boolean - Whether we should show a stroke on each segment
  //           //segmentShowStroke    : true,
  //           //String - The colour of each segment stroke
  //           segmentStrokeColor   : '#fff',
  //           //Number - The width of each segment stroke
  //           segmentStrokeWidth   : 2,
  //           //Number - The percentage of the chart that we cut out of the middle
  //           percentageInnerCutout: 50, // This is 0 for Pie charts
  //           //Number - Amount of animation steps
  //           animationSteps       : 100,
  //           //String - Animation easing effect
  //           animationEasing      : 'easeOutBounce',
  //           //Boolean - Whether we animate the rotation of the Doughnut
  //           animateRotate        : true,
  //           //Boolean - Whether we animate scaling the Doughnut from the centre
  //           animateScale         : false,
  //           //Boolean - whether to make the chart responsive to window resizing
  //           responsive           : true,
  //           // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  //           maintainAspectRatio  : true,
  //           //String - A legend template
  //           legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
  //         }
  //       });
  //     }
  //   };
  
  //   charts.init();
  
  // })(jQuery);