$(document).ready(function(){
     $( ".slider" ).slider({
            range: "min", 
            value: 1,
            min: 1, 
            max: $("#maxvalue").val(),
            step: 1, 

            slide: function( event, ui ) {
                $( "#slider-result" ).html(ui.value);
            }
     });
  });



