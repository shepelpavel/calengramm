<?php

setlocale(LC_ALL, 'ru_RU.UTF-8');

require_once($_SERVER['DOCUMENT_ROOT'] . '/core/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/fn/function.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/chunks/header.php');
?>

<div id="calendar"></div>
<div class="modal">
    <div class="modal__close js-modal-close"></div>
    <div id="modal" class="modal__body"></div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/chunks/footer.php');
?>