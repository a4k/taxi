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