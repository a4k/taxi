<?
global $USER;
?>
<table class="table orderList" id="orderClientList" data-user="<?= $USER; ?>">
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
            <button type="button" class="btn btn-primary askQuestion" data-id="1">Задать вопрос</button>
        </td>
    </tr>
    </tbody>
</table>