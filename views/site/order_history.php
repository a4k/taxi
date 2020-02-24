<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use app\models\Order;

$this->title = 'История заказов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-order_history">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    use yii\grid\GridView;

    if($dataProvider) {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => 'Список заказов пуст',
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
                    'attribute' => 'from',
                    'label' => 'Откуда',
                ],
                [
                    'attribute' => 'to',
                    'label' => 'Куда',
                ],
                [
                    'label' => 'Класс поездки',
                    'attribute' => 'drive_class',
                    'value' => function ($data) {
                        return Order::getDriveClass($data->drive_class);
                    },
                ],
                [
                    'label' => 'Статус',
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return Order::getStatus($data->status);
                    },
                ],
                [
                    'label' => 'Ссылка',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a('Просмотр', ['view_order', 'id' => $data->id]);
                    },
                ],
            ],
        ]);
    } else {
        print_r('Список заказов пуст');
    }

    ?>

</div>
