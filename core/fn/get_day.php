<?php

if (empty($_POST['timestamp'])) {
    return;
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/fn/function.php');

$day_timestamp = $_POST['timestamp'];
$events_arr = getEventsDay($day_timestamp);

$title = '<div class="modal__title">';
$title .= '<div class="modal__title_day-num">' . date('j', $day_timestamp) . '</div>';
$title .= '<div class="modal__title_date">' . date($monthsArr[date('n', $day_timestamp)] . ' o', $day_timestamp) . '</div>';
$title .= '</div>';

$events = '<div class="modal__events">';
if (!empty($events_arr)) {
    foreach ($events_arr as $k => $v) {
        if (empty($v['color'])) {
            $color = '0a0a0a';
        } else {
            $color = $v['color'];
        }
        $events .= '<div class="modal__events_event js-get-event" style="background-color: #' . $color . '" data-id="' . $v['id'] . '"><div class="modal__events_event_time">' . date('H:i', $v['date']) . '</div>&nbsp;<div class="modal__events_event_title">' . $v['title'] . '</div><div class="modal__events_event_button"><img src="/_assets/img/style/pen.png"></div><div class="modal__events_event_button"><img src="/_assets/img/style/trash.png"></div></div>';
    }
} else {
    $events .= '<div class="modal__events_empty">Нет событий</div>';
}
$events .= '</div>';

$result = $title . $events;

echo $result;
return;
