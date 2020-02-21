<?php

require "head.php";

require "header.php";

global $USER;
if (!isset($USER)) {
    ?>
    <script>
        window.location.href = '/login.php';
    </script>
    <?
    die();
}
?>


<? if (isDriver($USER)): ?>
    <h1>Дашбоард водителя</h1>

    <div class="text">
        <p>Список доступных поездок:</p>
    </div>
    <div class="list-group" id="topicsAll" data-parent="0" data-level="1">

    </div>
<? elseif (isAdmin($USER)): ?>
    <h1>Панель администратора</h1>

<? else: ?>
    <h1>Дашбоард клиента</h1>


<? endif; ?>

<?
require "footer.php";

?>