<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = "Заказ номер {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'История заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Заказ номер {$model->id}";
?>
<div class="news-view">

    <h1><?= Html::encode("Заказ номер {$model->id}") ?></h1>

    <p> <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?> </p>
    <p> <?= Html::encode($model->user_id)?> </p>

    <p align="center"> <?= Html::a('Все заказы', ['order_history']) ?> </p>

</div>