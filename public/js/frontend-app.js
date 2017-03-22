$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#login").click(function(event) {

        event.preventDefault();

        var dataForm = $("#login-form-content").serialize();
        $("#spinner").css('display', 'block');
        $("#login-email").attr('readonly', 'readonly');
        $("#login-password").attr('readonly', 'readonly');

        $.ajax({
                url: '/auth/login',
                type: 'POST',
                data: dataForm,
            })
            .done(function(data) {
                location.reload();
            })
            .fail(function(reason) {
                console.log(reason);
                var message = reason.responseJSON.email;
                $("#login-password").val('');
                $("#login-password").attr('autofocus');
                $("#login-email").parent().addClass('has-error');
                $("#login-email").next('.help-block').children('strong').text(message);
            })
            .always(function() {
                $("#spinner").css('display', 'none');
                $("#login-email").removeAttr('readonly');
                $("#login-password").removeAttr('readonly');
            });

    });
});
