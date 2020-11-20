<?php

if (empty($_POST['date'])) {
    return;
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/fn/function.php');

$timestamp = intval($_POST['date']);
$first_day_month = date('N', strtotime(date('Y-m-', $timestamp) . '01' . date(' H:i:s', $timestamp)));
$current_week_day = date('N', $timestamp);
$current_num_day = date('j', $timestamp);
$day_in_month = date('t', $timestamp);
$today = strtotime(date('Y-m-d'));

$result = '<table class="calendar"><tr class="calendar__row">';
$date_num = 1;
$date_week = '';
for ($i = 1; $i <= 42; $i++) {
    if ($i <= 7) {
        $weed_num = 1;
    } else if ($i > 7 && $i <= 14) {
        $weed_num = 2;
    } else if ($i > 14 && $i <= 21) {
        $weed_num = 3;
    } else if ($i > 21 && $i <= 28) {
        $weed_num = 4;
    } else if ($i > 28 && $i <= 35) {
        $weed_num = 5;
    } else if ($i > 35) {
        $weed_num = 6;
    }

    $date_week = $weekArr[$i % 7]['shorteng'];
    $date_timestamp = mktime(0, 0, 0, date('m', $timestamp), $date_num, date('Y', $timestamp));
    $events_arr = getEventsDay($date_timestamp);

    $events = '';
    foreach ($events_arr as $k => $v) {
        $events .= '<div class="calendar__event js-get-event" data-id="' . $v['id'] . '">' . $v['title'] . '</div>';
    }

    if ($i == 8 || $i == 15 || $i == 22 || $i == 29 || $i == 36) {
        $result .= '</tr><tr class="calendar__row">';
    }

    if ($i >= $first_day_month && $date_num <= $day_in_month) {
        $current_class = '';
        if ($date_timestamp == $today) {
            $current_class = 'today';
        }
        $result .= '<td class="calendar__row_item js-day current-month week-' . $date_week . ' ' . $current_class . '"><div class="calendar__day" data-day="' . $date_week . '" data-week="' . $weed_num . '" data-timestamp="' . $date_timestamp . '"><div class="calendar__day_num">' . $date_num . '</div>' . $events . '</div></td>';
        $date_num++;
    } else {
        $result .= '<td class="calendar__row_item other-month" ><div class="calendar__day" data-day="' . $date_week . '" data-week="' . $weed_num . '"></div></td>';
    }
}
$result .= '</tr></table>';

$prev_date = mktime(0, 0, 0, date('m', $timestamp) - 1, date('d', $timestamp), date('Y', $timestamp));
$next_date = mktime(0, 0, 0, date('m', $timestamp) + 1, date('d', $timestamp), date('Y', $timestamp));

$result .= '<div class="buttons">';
$result .= '<div class="button js-get-month" data-date="' . $prev_date . '">prev</div>';
$result .= '<div class="button js-get-month" data-date="' . $today . '">today</div>';
$result .= '<div class="button js-get-month" data-date="' . $next_date . '">next</div>';
$result .= '</div>';

echo $result;
return;
