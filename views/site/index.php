<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <? if (Yii::$app->user->isGuest): ?>
        <div class="jumbotron">
            <h1>Приветствуем!</h1>

            <p class="lead">Вы можете заказать такси через личный кабинет или стать водителем.</p>

            <p>
                <a class="btn btn-lg btn-success" href="/web/site/signup">Регистрация клиента</a>
                <a class="btn btn-lg btn-default" href="/web/site/signup_driver">Регистрация водителя</a>
            </p>
        </div>

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

            <div class="body-content">

                sdijf

            </div>
        <? elseif ($userGroupId == 'DRIVER'):?>

        <? elseif ($userGroupId == 'ADMIN'):?>

        <? endif; ?>

    <? endif; ?>
</div>
