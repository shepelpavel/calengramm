<?php

setlocale(LC_ALL, 'ru_RU.UTF-8');

require_once($_SERVER['DOCUMENT_ROOT'] . '/core/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/fn/function.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/chunks/header.php');
?>

<div id="calendar"></div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/chunks/footer.php');
?>