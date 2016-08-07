function finalTime(time) {
    return new Date().getTime() + time * 60 * 1000;
}

$(function () {

    $('.mainmenu-nav').after('<div class="logout-counter"><span></span></div>');

    $.request('onGetSessionData', {
        success: function (data) {

            var counter = $('.logout-counter span');

            counter.countdown(finalTime(data.lifetime))
                .on('update.countdown', function (event) {
                    $(this).html(event.strftime('%M:%S'));
                })
                .on('finish.countdown', function () {
                    window.location.replace('/' + data.redirect);
                });

            $(document).on('ajaxSuccess', function () {
                counter.countdown(finalTime(data.lifetime));
            });

        }
    });

});