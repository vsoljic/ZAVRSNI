$(document).ready(function () {

    $('#contactUsForm').validate({
        rules: {
            firstName: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            message: {
                minlength: 2,
                required: true
            },
            lastName: {
                minlength: 2,
                required: true
            },

            bookingNo: {
                maxlength: 6,
                required: true
            },

            comment: {
                minlength: 2,
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
       
        success: function (element) {
            element.text('OK!').addClass('has-success').closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });

});