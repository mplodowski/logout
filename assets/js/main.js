function finalTime(time) {
    return new Date().getTime() + time * 60 * 1000;
}

$(function () {

    $('.mainmenu-preview').after('<li class="logout-counter"><span></span></li>');

    $.request('onGetSessionData', {
        success: function (session) {
            var counter = $('.logout-counter span');

            counter.countdown(finalTime(session.lifetime))
                .on('update.countdown', function (countdown) {
                    $(this).html(countdown.strftime('%M:%S'));
                })
                .on('finish.countdown', function () {
                    window.location.replace(session.redirect);
                });

            $(document).on('ajaxSuccess', function () {
                var id = '#Form-field-Settings-lifetime';

                if ($(id).length) {
                    session.lifetime = $(id).val();
                }

                counter.countdown(finalTime(session.lifetime));
            });

        }
    });

});