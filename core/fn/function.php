<?php

// функция получения дня из БД
function getEventsDay($day_timestamp)
{
    global $dbhost, $dbuser, $dbpasswd, $dbname, $connect;
    $events = [];
    $day_start = $day_timestamp;
    $day_end = $day_timestamp + 86400;
    $query = "SELECT * FROM `events`
    WHERE
    (`date` BETWEEN $day_start AND $day_end)
    OR
    (`date` < $day_start AND `enddate` IS NOT NULL AND `enddate`!='' AND `enddate` > $day_start)
    ORDER BY `date` ASC;";
    $result = mysqli_query($connect, $query) or die('error');
    if ($result) {
        while ($res = $result->fetch_assoc()) {
            $events[] = [
                'id' => $res['id'],
                'title' => $res['title'],
            ];
        }
    }
    return $events;
}

// функция получения события из БД
function getEvent($event_id)
{
    global $dbhost, $dbuser, $dbpasswd, $dbname, $connect;
    $event = [];
    $query = "SELECT * FROM `events`
    WHERE
    `id` = $event_id";
    $result = mysqli_query($connect, $query) or die('error');
    if ($result) {
        $event = $result->fetch_assoc();
    }
    return $event;
}
