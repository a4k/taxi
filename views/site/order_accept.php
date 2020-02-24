<?php

use yii\helpers\Html;
use app\models\Order;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = "Заказ номер {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'История заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Заказ номер {$model->id}";
?>
<div class="news-view">

    <h1><?= Html::encode("Управление заказом номер {$model->id}") ?></h1>

    <ul class="list-group">
        <li class="list-group-item">
            <h1 class="heading">
                Заказ №<?= $model->getId() ?>
            </h1>
        </li>
        <li class="list-group-item">
            <b>Статус:</b> <?= Order::getStatusForDriver($model->status) ?>
        </li>
        <li class="list-group-item">
            <b>Дата создания:</b> <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
        </li>
        <li class="list-group-item">

            <? if ($model->status == Order::STATUS_DRIVER_WAITING): ?>

                <?= Html::a('Я на месте',
                    ['order_accept', 'id' => $model->id, 'type' => Order::STATUS_PASSENGER_WAITING],
                    ['class' => 'btn btn-primary']) ?>

            <? elseif ($model->status == Order::STATUS_PASSENGER_WAITING): ?>
                <?= Html::a('В путь',
                    ['order_accept', 'id' => $model->id, 'type' => Order::STATUS_DRIVING],
                    ['class' => 'btn btn-primary']) ?>

            <? elseif ($model->status == Order::STATUS_DRIVING): ?>
                <?= Html::a('Завершить поездку',
                    ['order_accept', 'id' => $model->id, 'type' => Order::STATUS_FINISH],
                    ['class' => 'btn btn-primary']) ?>

            <? elseif ($model->status == Order::STATUS_FINISH): ?>

            <? endif; ?>
            <?= Html::a('Все заказы', ['index'], ['class' => 'btn btn-default']) ?>
        </li>
    </ul>


</div>