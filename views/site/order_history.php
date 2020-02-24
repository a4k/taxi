<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'История заказов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-order_history">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    use yii\grid\GridView;

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'label' => 'Номер заказа',
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'format' => 'datetime',
            ],
            [
                'label' => 'Класс поездки',
                'attribute' => 'drive_class',
                'value' => function ($data) {
                    $driveClass = ['ECONOM' => 'Эконом', 'COMFORT' => 'Комфорт', 'CHILDREN' => 'Детский'];
                    return $driveClass[$data->drive_class];
                },
            ],
            [
                'label' => 'Статус',
                'attribute' => 'status',
                'value' => function ($data) {
                    $status = ['FREE' => 'Подбираем подходящего водителя',
                        'DRIVE_WAITING' => 'Ожидайте водителя', 'DRIVING' => 'В пути'];
                    return $status[$data->status];
                },
            ],
            [
                'label' => 'Ссылка',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('Просмотр', ['view_order', 'id' => $data->id]);
                }
            ],
        ],
    ]);
    ?>

</div>
