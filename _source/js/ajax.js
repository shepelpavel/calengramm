// функция получения контента каталогов
function getMonth(date) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_month.php',
        data: "date=" + date,
        success: function (data) {
            $('#calendar').animate({
                opacity: 0
            }, 300, function () {
                $('#calendar').html(data);
            });
            $('#calendar').animate({
                opacity: 1
            }, 300);
        }
    });
}

function getEvent(id) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_event.php',
        data: "id=" + id,
        success: function (data) {
            $('#modal').html(data);
            $('.modal').fadeIn();
        }
    });
}

$(document).ready(function () {

    // получение стартовой страницы
    getMonth(Math.round(new Date().getTime() / 1000));

    // получение месяца
    $(document).on('click', '.js-get-month', function (e) {
        var _date = $(e.target).attr('data-date');
        getMonth(_date);
    });

    // получение события
    $(document).on('click', '.js-get-event', function (e) {
        var _event_id = $(e.target).attr('data-id');
        getEvent(_event_id);
    });

    $(document).on('click', function (e) {
        if (
            !$(e.target).closest('#modal').length &&
            !$(e.target).hasClass('js-get-event')
        ) {
            $('.modal').fadeOut();
        }
        e.stopPropagation();
    });

    // перехват клавиши "назад"
    history.pushState(null, null, location.href);
    window.onpopstate = function (e) {
        history.go(1);
    };

});