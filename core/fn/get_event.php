<?php

if (empty($_POST['id'])) {
    return;
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/fn/function.php');

$event_id = $_POST['id'];
$event_arr = getEvent($event_id);

$title = '<div class="modal__body_title">' . $event_arr['title'] . '</div>';
$description = '';
if (!empty($event_arr['description'])) {
    $description = '<div class="modal__body_title">' . $event_arr['description'] . '</div>';
}

$result = $title . $description;

echo $result;
return;
