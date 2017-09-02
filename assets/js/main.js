function finalTime(time) {
    return new Date().getTime() + time * 1000;
}

$(function () {
    $('.mainmenu-preview').after('<li class="logout-counter"><span></span></li>');

    $.request('onGetLogoutSettings', {
        success: function (settings) {
            var el = $('.logout-counter span');

            el.countdown(finalTime(settings.lifetime), function (event) {
                $(this).html(event.strftime(settings.format));
            }).on('finish.countdown', function () {
                window.location.replace(settings.redirect);
            });

            $(document).on('ajaxSuccess', function () {
                var id = '#Form-field-Settings-lifetime';

                if ($(id).length) {
                    settings.lifetime = $(id).val();
                }

                el.countdown(finalTime(settings.lifetime));
            });
        }
    });
});