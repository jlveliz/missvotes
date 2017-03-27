$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /***   LOGIN  **/

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
                    $("#login-email").next('.help-block').children('strong').text(message);
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

    $("#go-reset").on('click', function(event) {
        event.preventDefault();
        $("#login-modal").modal('hide');
        $("#reset-modal").modal('show');
    });

    /***   LOGIN  **/


    /***   REGISTER  **/
    $("#register-form-content").validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/auth/verify",
                    method: 'POST',
                    data: {
                        email: function() {
                            return $("#register-email").val()
                        }
                    },
                }
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
                    // location.reload();
                })
                .fail(function(reason) {})
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


    /******** RESET ********/
    $("#reset-form-content").validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/auth/password-verify-email",
                    method: 'POST',
                    data: {
                        email: function() {
                            return $("#reset-email").val()
                        }
                    },
                }
            }
        },
        messsages: {
            email: {
                required: "Ingrese un correo",
                email: "El correo tiene un formato inválido"
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
        }
    });
    /******** RESET ********/
});
