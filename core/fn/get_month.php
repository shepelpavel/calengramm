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

$result = '<table><tr>';
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

    if ($i == 8 || $i == 15 || $i == 22 || $i == 29 || $i == 36) {
        $result .= '</tr><tr>';
    }

    if ($i >= $first_day_month && $date_num <= $day_in_month) {
        $current_class = '';
        if ($date_timestamp == $today) {
            $current_class = 'today';
        }
        $result .= '<td class="current-month ' . $current_class . '" data-day="' . $date_week . '" data-week="' . $weed_num . '" data-timestamp="' . $date_timestamp . '">' . $date_num . '<span>' . $events_arr[0]['title'] . '</span></td>';
        $date_num++;
    } else {
        $result .= '<td class="other-month" data-day="' . $date_week . '" data-week="' . $weed_num . '">---</td>';
    }
}
$result .= '</tr></table>';

$prev_date = mktime(0, 0, 0, date('m', $timestamp) - 1, date('d', $timestamp), date('Y', $timestamp));
$next_date = mktime(0, 0, 0, date('m', $timestamp) + 1, date('d', $timestamp), date('Y', $timestamp));

$result .= '<button class="js-get-month" data-date="' . $prev_date . '">prev</button>';
$result .= '<button class="js-get-month" data-date="' . $today . '">today</button>';
$result .= '<button class="js-get-month" data-date="' . $next_date . '">next</button>';

echo $result;
return;
