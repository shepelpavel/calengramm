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
                $(window).scrollTop(0);
            });
            $('#calendar').animate({
                opacity: 1
            }, 300);
        }
    });
}

$(document).ready(function () {

    // получение стартовой страницы
    getMonth(Math.round(new Date().getTime() / 1000));

    // получение месяца
    $('body').on('click', '.js-get-month', function(e) {
        var _date = $(e.target).attr('data-date');
        getMonth(_date)
    });

    // перехват клавиши "назад"
    history.pushState(null, null, location.href);
    window.onpopstate = function (e) {
        history.go(1);
    };

});