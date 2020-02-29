<?php

use yii\helpers\Html;
use app\models\Order;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $modelDriver app\models\Order */

$this->title = "Заказ номер {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'История заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Заказ номер {$model->id}";

?>
<div class="news-view">

    <h1><?= Html::encode("Заказ номер {$model->id}") ?></h1>

    <ul class="list-group">
        <li class="list-group-item">
            <h1 class="heading">
                Заказ №<?= $model->getId() ?>
            </h1>
        </li>
        <li class="list-group-item">
            <b>Статус:</b> <?= Order::getStatus($model->status) ?>
        </li>
        <li class="list-group-item">
            <b>Дата создания:</b> <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
        </li>
        <? if (!empty($model->driver) && isset($model->driver->id)): ?>
            <li class="list-group-item">
                <b>Водитель:</b> <?= $model->driver->username ?>
            </li>
            <li class="list-group-item">
                <b>Машина:</b> <?= $model->driver->car_name ?>
            </li>
            <li class="list-group-item">
                <b>Цвет машины:</b> <?= $model->driver->car_color ?>
            </li>
            <li class="list-group-item">
                <b>Номер машины:</b> <?= $model->driver->car_number ?>
            </li>
        <? endif; ?>
        <li class="list-group-item">
            <?= Html::a('Все заказы', ['index'], ['class' => 'btn btn-default']) ?>
        </li>
    </ul>

</div>