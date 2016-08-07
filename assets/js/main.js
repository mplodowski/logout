$(function () {

    $('.mainmenu-nav').after('<div class="logout-counter"><span></span></div>');

    $.request('onGetSessionData', {
        success: function (data) {

            if (data.lifetime != 0) {

                var lifetime = new Date().getTime() + data.lifetime * 60 * 1000;

                $('.logout-counter span').countdown(lifetime)
                    .on('update.countdown', function (event) {
                        $(this).html(event.strftime('%M:%S'));
                    })
                    .on('finish.countdown', function () {
                        window.location.replace('/' + data.redirect);
                    });
            }

        }
    });

});