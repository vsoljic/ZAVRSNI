 $(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('value') == 'povratni') {
            $('label[for=returnFlight], input#returnFlight').show();    
            $('label[for=returnFlight], input#returnFlight').disabled = false;        
       }

       else {
            $('label[for=returnFlight], input#returnFlight').hide(); 
            $('label[for=returnFlight], input#returnFlight').disabled = true;  
            $( "#returnFlight").datepicker('setDate', null);
       }
   });
});

 function hideReturnFlight(){
 	 $('label[for=returnFlight], input#returnFlight').hide();  
 	 $('label[for=returnFlight], input#returnFlight').disabled = true;
 }

