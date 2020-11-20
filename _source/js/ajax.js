// функция получения месяца
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

// функция получения дня
function getDay(day_timestamp) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_day.php',
        data: "timestamp=" + day_timestamp,
        success: function (data) {
            $('#modal').html(data);
            $('.modal').fadeIn();
        }
    });
}

// функция получения события
function getEvent(id) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_event.php',
        data: "id=" + id,
        success: function (data) {
            $('.modal').fadeOut(function () {
                $('#modal').html(data);
                $('.modal').fadeIn();
            });
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

    // получение дня
    $(document).on('click', '.js-get-day', function (e) {
        if ($(e.target).hasClass('js-get-day')) {
            var _day_timestamp = $(e.target).attr('data-timestamp');
        } else {
            var _day_timestamp = $(e.target).closest('.js-get-day').attr('data-timestamp');
        }
        getDay(_day_timestamp);
    });

    // получение события
    $(document).on('click', '.js-get-event', function (e) {
        var _event_id = $(e.target).attr('data-id');
        getEvent(_event_id);
    });

    // закрытие модалки
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