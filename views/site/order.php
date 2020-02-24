<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\OrderForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Заказ такси';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-order">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'order-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'from')->textInput(['autofocus' => true])
        ->hint('Введите откуда')->label('Откуда') ?>
    <?= $form->field($model, 'to')->textInput()
        ->hint('Введите куда')->label('Куда') ?>
    <?= $form->field($model, 'phone')
        ->textInput(['value' => Yii::$app->user->identity->getPhone()])
        ->hint('Введите телефон')->label('Телефон') ?>
    <?= $form->field($model, 'drive_class')->dropdownList([
        'ECONOM' => 'Эконом от 59 Р.',
        'COMFORT' => 'Комфорт от 99 Р.',
        'CHILDREN' => 'Детский от 89 Р.',
    ]
    );?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Вызвать такси', ['class' => 'btn btn-primary', 'name' => 'order-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
