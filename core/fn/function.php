<?php

// функция получения контента страницы из БД
function getEventsDay($day_timestamp)
{
    global $dbhost, $dbuser, $dbpasswd, $dbname, $connect;
    $result = 'error';
    $day_start = $day_timestamp;
    $day_end = $day_timestamp + 86400;
    $query = "SELECT `title`,`description`
    FROM `events`
    WHERE
    (`date` BETWEEN $day_start AND $day_end)
    OR
    (`date` < $day_start AND `enddate` IS NOT NULL AND `enddate`!='' AND `enddate` > $day_start);";
    $result = mysqli_query($connect, $query) or die('error');
    if ($result) {
        $events = [];
        while ($res = $result->fetch_assoc()) {
            $events[] = [
                'id' => $res['id'],
                'title' => $res['title'],
                'description' => $res['description']
            ];
        }
    }
    return $events;
}
