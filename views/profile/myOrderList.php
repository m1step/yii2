<?php
use yii\helpers\Url;
?>

<div class="container">
    <h2>Привет, <?= $user->name; ?></h2>
    <ul class="nav nav-pills">
        <li role="presentation"><a href="<?= Url::to(['profile/index']) ?>">Мои данные</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-order-list']) ?>">Мои заказы</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-wish-list']) ?>">Мой список желаний</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/change-email']) ?>">Изменить email</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/request-password-reset']) ?>">Изменить пароль</a></li>
        <li role="presentation"><a href="<?= Url::to(['site/logout']) ?>">Выход</a></li>
    </ul>
    <?php if(empty($orderList)): ?>
        <h2>Вы еще ничего не заказали</h2>
        <br />
    <?php else: ?>
        <br />
        <ul class="list-group">
        <?php foreach($orderList as $order): ?>
            <li class="list-group-item" data-id="<?= $order->id; ?>">
                <span class="badge"><?= $order->sum; ?></span>
                Заказ #<?= $order->id; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>