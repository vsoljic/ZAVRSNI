$(document).on('change', 'input', function() {
    $('.form-group > input').keyup(function() {

        var empty = false;
        $('.form-group > input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#personalDtBt').attr('disabled', 'disabled'); 
        } else {
            $('#personalDtBt').removeAttr('disabled'); 
        }
    });
});