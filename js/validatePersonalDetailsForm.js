
//FOR ERROR MESSAGES - TO BE DISPLAYED BELOW INPUT
$(document).ready(function () {
    $.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

    $('#personalDetailsForm').validate({
        rules: {
            passengerName: {
                minlength: 2,
                required: true
            },

            passengerLastName: {
                minlength: 2,
                required: true
            },

             oib: {
                minlength:11,
                maxlength: 11,
                required: true
            },
            
            street: {
                minlength: 2,
                required: true
            },

            city: {
                minlength: 2,
                required: true
            },

            zipcode: {
                minlength: 2,
                required: true
            },

            state: {
                minlength: 2,
                required: true
            },

            telNo: {
                minlength: 2,
                required: true
            },


            email: {
                minlength: 2,
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
       
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });

});


$(document).on('change', 'input', function() {
  (function() {
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
})()
});


