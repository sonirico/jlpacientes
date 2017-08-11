$(function () {
    $('[name="current_password"]').focus();

    $('#password-reset-form').submit(function (e) {
        var newPassword = $('[name="new_password"]').val().trim();
        var repeatNewPassword = $('[name="password_confirmation"]').val().trim();

        if (newPassword !== repeatNewPassword) {
            var message = '<strong>La contraseña actual y la repetida no coinciden.</strong>';
            var cont = $('#front-errors-container');

            cont.html(message);
            cont.stop(true, true).show().fadeOut(10000);

            e.preventDefault();
        }
    });

    $('input').on('focus', function () {
        $('#front-errors-container').stop(true, true).hide();
    });
});
