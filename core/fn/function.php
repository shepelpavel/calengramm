<?php

// функция получения контента страницы из БД
function getEventsDay($day_timestamp)
{
    global $dbhost, $dbuser, $dbpasswd, $dbname, $connect;
    $result = 'error';
    $day_start = $day_timestamp;
    $day_end = $day_timestamp + 86400;
    $query = "SELECT `title`,`description` FROM `events` WHERE `date` BETWEEN $day_start and $day_end;";
    $result = mysqli_query($connect, $query) or die('error');
    if ($result) {
        $events = [];
        while ($res = $result->fetch_assoc()) {
            $events[] = [
                'title' => $res['title'],
                'description' => $res['description']
            ];
        }
    }
    return $events;
}
