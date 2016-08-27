$(document).ready(function(){
    var table = $('#chooseFlightTable').DataTable();
    var returnTable = $('#chooseReturnFlightTable').DataTable();
 
    $('#chooseFlightTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

    });

    $('#chooseReturnFlightTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            returnTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
 
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    });

   

});