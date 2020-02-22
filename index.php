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
                <button type="button" class="btn btn-primary viewPath" data-id="1">Посмотреть маршрут</button>
                <button type="button" class="btn btn-primary chooseOrder" data-id="1">Выбрать</button>
            </td>
        </tr>
        </tbody>
    </table>
<? elseif (isAdmin($USER)): ?>
    <h1>Панель администратора</h1>

<? else: ?>
    <h1>Заказ такси</h1>

    <form id="orderForm" method="post" action="">

        <input type="hidden" name="owner_login" value="<?= $USER; ?>">
        <input type="hidden" name="cost" value="100">
        <div class="form-group">
            <label for="place_form">Откуда</label>
            <input type="text" name="place_form" class="form-control" id="placeFrom">
        </div>
        <div class="form-group">
            <label for="place_to">Куда</label>
            <input type="text" name="place_to" class="form-control" id="placeTo">
        </div>
        <div class="form-group">
            <label for="car_class">Класс</label>
            <select name="car_class" id="car_class" class="form-control">
                <option value="ECONOM">Эконом</option>
                <option value="COMFORT">Комфорт</option>
                <option value="CHILDREN">Детский</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Заказать</button>
    </form>

<? endif; ?>

<?
require "footer.php";

?>