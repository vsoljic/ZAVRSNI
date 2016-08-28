$(document).ready(function() {
    $("#logindiv").hide();
    stepByStepEnableInputs();
    $('#departureCity, #arrivalCity, #outGoingFlight, #returnFlight').change(stepByStepEnableInputs); 
    
   	$("#onclick").click(function() {
        $("#logindiv").css("display", "block");
    });

    $("#login #cancel").click(function() {
        $(this).parent().parent().hide();
    });


    
    // Login form popup login-button click event.
    $("#loginbtn").click(function() {
        var name = $("#username").val();
        var password = $("#password").val();
        if (username == "" || password == "") {
            alert("Username or Password was Wrong");
        } else {
            $("#logindiv").css("display", "none");
        }
    });
   
});

// STEP BY STEP SELECTION 
    function stepByStepEnableInputs(){
    if (($('#departureCity').val().length == 0) ||
        ($('#arrivalCity').val().length == 0)) {
            $("#outGoingFlight").datepicker("option", "disabled", true);
            $("#returnFlight").datepicker("option", "disabled", true);
            $("#findFlightBtn").prop("disabled", true);
            $("input[type=text]").css("background-color", "#ccc");

    } else if (($('#departureCity').val().length > 0) &&
        ($('#arrivalCity').val().length > 0) && ($('#outGoingFlight').datepicker('getDate') == null) &&
        ($('#returnFlight').datepicker('getDate') == null)){
            $("#outGoingFlight").datepicker("option", "disabled", false);
            $("#returnFlight").datepicker("option", "disabled", false);
            $("#findFlightBtn").prop("disabled", true);
            $("input[type=text]").css("background-color", "white");
    } else if(($('#departureCity').val().length > 0) &&
        ($('#arrivalCity').val().length > 0) && ($('#outGoingFlight').datepicker('getDate') != null) ||
        ($('#returnFlight').datepicker('getDate') != null)) {
            $("#outGoingFlight").datepicker("option", "disabled", false);
            $("#returnFlight").datepicker("option", "disabled", false);
            $("input[type=text]").css("background-color", "white");
            $("#findFlightBtn").prop("disabled", false);

    };


};