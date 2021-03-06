$(function() {
        	var dateToday = new Date();
            $( "#outGoingFlight" ).datepicker({
              defaultDate: "+1w",
              dateFormat: 'dd.mm.yy.',  
              changeMonth: true,
              numberOfMonths: 2,
              minDate: dateToday,
              onClose: function( selectedDate ) {
                $( "#returnFlight" ).datepicker( "option", "minDate", selectedDate );
              }
            });
            $( "#returnFlight" ).datepicker({
              defaultDate: "+1w",
              dateFormat: 'dd.mm.yy.',
              changeMonth: true,
              numberOfMonths: 2,
              onClose: function( selectedDate ) {
                $( "#outGoingFlight" ).datepicker( "option", "maxDate", selectedDate );
              }
            });

              $( "#flightStartDate" ).datepicker({
              defaultDate: "+1w",
              dateFormat: 'dd.mm.yy.',
              changeMonth: true,
              numberOfMonths: 2,
              onClose: function( selectedDate ) {
                $( "#flightEndDate" ).datepicker( "option", "minDate", selectedDate );
              }
            });

              $( "#flightEndDate" ).datepicker({
              defaultDate: "+1w",
              dateFormat: 'dd.mm.yy.',
              changeMonth: true,
              numberOfMonths: 2,
              onClose: function( selectedDate ) {
                $( "#flightStartDate" ).datepicker( "option", "maxDate", selectedDate );
              }
            });

    });