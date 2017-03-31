$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /***   LOGIN  **/

    $("#login-modal").on('show.bs.modal', function() {
        $("#login-email").val('');
        $("#login-email").parent().removeClass('has-error');
        $("#login-email").next().text('');
        $("#login-email").attr('autofocus', 'autofocus');
        $("#login-password").val('');
        $("#login-password").parent().removeClass('has-error');
        $("#login-password").next().text('');
        $(".loginmodal-container").removeClass('animated shake');
    });

    $("#login-form-content").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: 'Correo requerido',
                email: 'Correo Inválido'
            },
            password: 'Contraseña requerida'
        },
        highlight: function(element) {
            $(".loginmodal-container").addClass('animated shake');
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(".loginmodal-container").removeClass('animated shake');
        },
        errorElement: 'strong',
        errorClass: 'help-block',
        submitHandler: function(form) {

            event.preventDefault();

            var dataForm = $(form).serialize();
            $("#spinner").css('display', 'block');
            $("#login-email").attr('readonly', 'readonly');
            $("#login-password").attr('readonly', 'readonly');
            $(".loginmodal-container").removeClass('animated shake');

            $.ajax({
                    url: '/auth/login',
                    type: 'POST',
                    data: dataForm,
                })
                .done(function(data) {
                    $("#login-modal").modal('hide');
                    location.reload();
                })
                .fail(function(reason) {
                    var message = reason.responseJSON.email;
                    $("#login-password").val('');
                    $("#login-password").attr('autofocus');
                    $("#login-email").parent().addClass('has-error');
                    $("#login-email").next('.help-block').text(message);
                    $("#login-email").next('.help-block').css('display', 'block');
                    $(".loginmodal-container").addClass('animated shake');
                })
                .always(function() {
                    $("#spinner").css('display', 'none');
                    $("#login-email").removeAttr('readonly');
                    $("#login-password").removeAttr('readonly');
                });
        }
    });

    $("#go-register").on('click', function(event) {
        event.preventDefault();
        $("#login-form-content")[0].reset();
        $("#login-modal").modal('hide');
        $("#register-modal").modal('show');
    });

    $("#go-email").on('click', function(event) {
        event.preventDefault();
        $("#login-modal").modal('hide');
        $("#email-modal").modal('show');
    });

    $("#go-activation").on('click', function(event) {
        event.preventDefault();
        $("#login-modal").modal('hide');
        $("#activation-modal").modal('show');
    });

    /***   LOGIN  **/


    /***   REGISTER  **/

    $("#register-modal").on('show.bs.modal', function() {
        $("#register-email").val('');
        $("#register-email").parent().removeClass('has-error');
        $("#register-email").next().text('');
        $("#register-email").attr('autofocus', true);

        $("#register-name").val('');
        $("#register-name").parent().removeClass('has-error');
        $("#register-name").next().text('');

        $("#register-address").val('');
        $("#register-address").parent().removeClass('has-error');
        $("#register-address").next().text('');

        $("#register-password").val('');
        $("#register-password").parent().removeClass('has-error');
        $("#register-password").next().text('');

        $("#register-password-confirmation").val('');
        $("#register-password-confirmation").parent().removeClass('has-error');
        $("#register-password-confirmation").next().text('');

        $(".registermodal-container").removeClass('animated shake');
    })

    $("#register-form-content").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            name: {
                required: true,
                minlength: 6
            },
            address: {
                required: true,
                minlength: 6
            },
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                equalTo: "#register-password"
            }
        },
        messages: {
            email: {
                required: "EL correo es requerido",
                email: "Correo inválido"
            },
            name: {
                required: "Nombre requerido",
                minlength: "Debe tener al menos 6 caracteres"
            },
            address: {
                required: "Dirección requerido",
                minlength: "Debe tener al menos 6 caracteres"
            },
            password: {
                required: "Contraseña requerida",
                minlength: "Ingrese al menos 6 caracteres"
            },
            password_confirmation: {
                required: "Confirmación de contraseña requerida",
                equalTo: "Las contraseñas no coinciden"
            }
        },
        highlight: function(element) {
            $(".registermodal-container").addClass('animated shake');
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(".registermodal-container").removeClass('animated shake');
        },
        errorElement: 'strong',
        errorClass: 'help-block',
        submitHandler: function(form) {

            event.preventDefault();

            var dataForm = $(form).serialize();
            $("#spinner").css('display', 'block');
            $("#register-email").attr('readonly', 'readonly');
            $("#register-name").attr('readonly', 'readonly');
            $("#register-address").attr('readonly', 'readonly');
            $("#register-password").attr('readonly', 'readonly');
            $("#password-confirmation").attr('readonly', 'readonly');
            $(".registermodal-container").removeClass('animated shake');

            $.ajax({
                    url: '/auth/register',
                    type: 'POST',
                    data: dataForm,
                })
                .done(function(data) {
                    $("#register-modal").modal('hide');
                    $("#register-message-success-modal").modal('show');
                })
                .fail(function(reason) {
                    console.log(reason);
                })
                .always(function() {
                    $("#spinner").css('display', 'none');
                    $("#register-email").removeAttr('readonly', 'readonly');
                    $("#register-name").removeAttr('readonly', 'readonly');
                    $("#register-address").removeAttr('readonly', 'readonly');
                    $("#register-password").removeAttr('readonly', 'readonly');
                    $("#password-confirmation").removeAttr('readonly', 'readonly');
                });
        }
    })

    $("#go-login").on('click', function(event) {
        event.preventDefault();
        $("#register-form-content")[0].reset();
        $("#login-modal").modal('show');
        $("#register-modal").modal('hide');
    });
    /***   REGISTER  **/


    /******** RESEND EMAIL ********/

    $("#email-modal").on('show.bs.modal', function() {
        $("#email-email").val('');
        $("#email-email").parent().removeClass('has-error');
        $("#email-email").next().text('');
        $("#email-email").attr('autofocus', true);
        $(".emailmodal-container").removeClass('animated shake');
    });

    $("#email-form-content").validate({
        rules: {
            email: {
                required: true,
                email: true,
            }
        },
        messages: {
            email: {
                required: "Ingrese un correo",
                email: "Por favor ingrese un correo valido"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
            $(".emailmodal-container").addClass('animated shake');
        },
        unhighlight: function(element) {
            $(".emailmodal-container").removeClass('animated shake');
        },
        errorElement: 'strong',
        errorClass: 'help-block',
        submitHandler: function(form) {
            event.preventDefault();
            var dataForm = $(form).serialize();
            $("#spinner").css('display', 'block');
            $("#email-email").attr('readonly');
            $(".emailmodal-container").removeClass('animated shake');

            $.ajax({
                    url: '/auth/send-reset-email',
                    type: 'POST',
                    data: dataForm,
                })
                .done(function() {
                    $("#email-modal").modal('hide');
                    $("#email-succees-modal").modal('show');
                })
                .fail(function(reason) {
                    var message = reason.responseJSON;
                    $("#email-password").attr('autofocus');
                    $("#email-email").next('.help-block').text(message);
                    $("#email-email").parent().addClass('has-error');
                    $("#email-email").next('.help-block').css('display', 'block');
                    $(".emailmodal-container").addClass('animated shake');
                })
                .always(function() {
                    $("#spinner").css('display', 'none');
                    $("#email-email").removeAttr('readonly', 'readonly');
                });

        }
    });



    /******** RESEND EMAIL ********/



    /******** ACTIVATION CODE ********/
    $("#activation-modal").on('show.bs.modal', function() {
        $("#activation-email").val('');
        $("#activation-email").parent().removeClass('has-error');
        $("#activation-email").next().text('');
        $("#activation-email").attr('autofocus', true);
        $(".activationmodal-container").removeClass('animated shake');
    });


    $("#activation-form-content").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Ingrese un correo",
                email: "Por favor ingrese un correo valido"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
            $(".emailmodal-container").addClass('animated shake');
        },
        unhighlight: function(element) {
            $(".emailmodal-container").removeClass('animated shake');
        },
        errorElement: 'strong',
        errorClass: 'help-block',
        submitHandler: function(form) {
            event.preventDefault();
            var dataForm = $(form).serialize();
            $.ajax({
                    url: '/auth/activate',
                    type: 'POST',
                    data: dataForm,
                })
                .done(function() {
                    $("#activation-message-success-modal").modal('show');
                    $("#activation-modal").modal('hide');
                })
                .fail(function(reason) {
                    var message = reason.responseJSON;
                    $("#activation-email").parent().addClass('has-error');
                    $("#activation-email").next('.help-block').text(message);
                    $("#activation-email").next('.help-block').css('display', 'block');
                    $(".activationmodal-container").addClass('animated shake');
                })
                .always(function() {
                    $("#spinner").css('display', 'none');
                });

        }

    })

    /******** ACTIVATION CODE ********/
});
