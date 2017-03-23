$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#login").click(function(event) {

        var thisModal = $(this);

        event.preventDefault();

        var dataForm = $("#login-form-content").serialize();
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
                thisModal.modal('hide');
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

    });
});
