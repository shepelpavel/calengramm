<?php

// функция получения контента страницы из БД
function get_pages_content($name)
{
    global $dbhost, $dbuser, $dbpasswd, $dbname, $connect;
    $result = 'error';
    $query = 'SELECT `content` FROM `pages_content` WHERE `name` = "' . $name . '";';
    $content = mysqli_query($connect, $query) or die('error');
    if ($content) {
        $content = $content->fetch_assoc();
        $result = $content['content'];
    }
    return $result;
}
