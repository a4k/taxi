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
    <table class="table orderList" id="orderDriverList">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Время</th>
            <th scope="col">Откуда</th>
            <th scope="col">Куда</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Информация о заказе</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>00:01</td>
            <td>ул. Кирова 23</td>
            <td>ул. Удмуртская, 240</td>
            <td>125 руб.</td>
            <td>-</td>
            <td>
                <button type="button" class="btn btn-primary viewPath">Посмотреть маршрут</button>
                <button type="button" class="btn btn-primary chooseOrder">Выбрать</button>
            </td>
        </tr>
        </tbody>
    </table>
<? elseif (isAdmin($USER)): ?>
    <h1>Панель администратора</h1>

<? else: ?>
    <h1>Дашбоард клиента</h1>


<? endif; ?>

<?
require "footer.php";

?>