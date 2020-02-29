<?php

/* @var $this yii\web\View */
/* @var $modelOrder app\models\OrderForm */
/* @var $modelOrderDriveHistory yii\data\ActiveDataProvider */

/* @var $modelOrderDriveAvailable yii\data\ActiveDataProvider */

/* @var $modelCurrentDrive app\models\Order */

use yii\helpers\Html;
use app\models\Order;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <? if (Yii::$app->user->isGuest): ?>
        <div class="jumbotron">
            <h1>Приветствуем!</h1>

            <p class="lead">Вы можете заказать такси через личный кабинет или стать водителем.</p>

            <p>
                <?= Html::a('Войти', ['login'], ['class' => 'btn btn-lg btn-success']) ?>
                <?= Html::a('Регистрация клиента', ['signup'], ['class' => 'btn btn-lg btn-default']) ?>
            </p>
        </div>

        <hr>
        <div class="container">
            <h1>Что такое АИС Такси?</h1>
            <p>
                Cервис, который позволяет быстро вызвать официальное такси без звонка диспетчеру и следить за выполнением заказа.
            </p>
            <br>
            <h4>Основные возможности</h4>
            <ul>
                <li>удобный вызов такси без звонка диспетчеру;</li>
                <li>выгодные тарифы вне зависимости от расстояния;</li>
                <li>фиксированная цена поездки в аэропорт Ижевска, на железнодорожный вокзал или на вокзал;</li>
                <li>оплата наличными;</li>
                <li>
                    быстрый поиск машины с учетом пожеланий пассажира (детское кресло, бизнес-класс и т.д.);
                </li>
                <li>
                    приложение показывает подробную информацию о водителе и его автомобиле;
                </li>
                <li>
                    статус водителя отображается в личном кабинете.

                </li>
            </ul>

        </div>

        <hr>
        <div class="container">
            <h1>Как начать работу водителем</h1>
            <br>
            <ul class="list-group ">
                <li class="list-group-item">1. Оставьте заявку</li>
                <li class="list-group-item">2. Мы позвоним вам, чтобы уточнить детали</li>
                <li class="list-group-item">3. Оформитесь в таксопарке</li>
                <li class="list-group-item">4. Выходите на линию и начинайте зарабатывать</li>
            </ul>
            <p>
                <?= Html::a('Оставить заявку', ['signup_driver'], ['class' => 'btn btn-lg btn-primary']) ?>
            </p>
        </div>

        <hr>

        <div class="body-content">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Алексей</h2>

                    <p>Крутая система Хорошо придумали Хорошо придумали Хорошо придумали </p>

                    <p><a class="btn btn-default" href="#">Полный отзыв &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Иван</h2>

                    <p>Хорошо придумали Хорошо придумали Хорошо придумали Хорошо придумали Хорошо придумали </p>

                    <p><a class="btn btn-default" href="#">Полный отзыв &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Алексей</h2>

                    <p>Крутая система Хорошо придумали Хорошо придумали Хорошо придумали Хорошо придумали Хорошо
                        придумали </p>

                    <p><a class="btn btn-default" href="#">Полный отзыв &raquo;</a></p>
                </div>
            </div>

        </div>

    <? else: ?>
        <?
        $userId = Yii::$app->user->identity->getId();
        $userGroupId = Yii::$app->getUser()->identity->getGroupId();

        if ($userGroupId == 'CLIENT'):?>

            <? if ($modelCurrentDrive): ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h1 class="heading">
                            Заказ №<? print_r($modelCurrentDrive->getId()); ?>
                        </h1>
                    </li>
                    <li class="list-group-item">
                        <b>Статус:</b> <?= Order::getStatus($modelCurrentDrive->status) ?>
                    </li>
                    <li class="list-group-item"><?= Html::a('Просмотр заказа',
                            ['order_view', 'id' => $modelCurrentDrive->getId()],
                            ['class' => 'btn btn-primary']) ?></li>
                </ul>

            <? endif; ?>

            <div class="body-content">
                <?= Html::a('История заказов', ['order_history'], ['class' => 'btn btn-default']) ?>

                <?= $this->render('order', ['model' => $modelOrder]); ?>

            </div>
        <? elseif ($userGroupId == 'DRIVER'): ?>
            <? if (!empty($modelCurrentDrive)): ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h1 class="heading">
                            Заказ №<?= $modelCurrentDrive->getId() ?>
                        </h1>
                    </li>
                    <li class="list-group-item">
                        <b>Статус:</b> <?= Order::getStatusForDriver($modelCurrentDrive->status) ?>
                    </li>
                    <li class="list-group-item"><?= Html::a('Управление заказом',
                            ['order_accept', 'id' => $modelCurrentDrive->getId()],
                            ['class' => 'btn btn-primary']) ?></li>
                </ul>

            <? endif; ?>

            <? if (!empty($modelOrderDriveAvailable)): ?>
                <?= $this->render('order_available', ['dataProvider' => $modelOrderDriveAvailable]); ?>
            <? endif; ?>
            <?= $this->render('order_driver_history', ['dataProvider' => $modelOrderDriveHistory]); ?>

        <? elseif ($userGroupId == 'ADMIN'): ?>

        <? endif; ?>

    <? endif; ?>
</div>
