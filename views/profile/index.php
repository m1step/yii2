<?php
use yii\helpers\Url;
$image = $user->getImage();
?>
<div class="container">
    <h2>Привет, <?= $user->name; ?></h2>
    <!--<div class="right-side col-md-3">
            <?/*= \yii\helpers\Html::img($image->getUrl(), ['class' => 'image']); */?>
        <div class="overlay">
            <div class="text">
                <form name="test" method="post" action="">
                <input id="upload" type="file"/>
                <input type="submit" id="upload-submit">
                <a href="#" id="upload_link">
                    <?/*= \yii\helpers\Html::img('@web/images/jpg-icon.png', ['width' => 150, 'height' => 150]); */?>
                </a>
                </form>
            </div>
        </div>
    </div>-->
    <ul class="nav nav-pills">
        <li role="presentation"><a href="<?= Url::to(['profile/index']) ?>">Мои данные</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-order-list']) ?>">Мои заказы</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-wish-list']) ?>">Мой список желаний</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/change-email']) ?>">Изменить email</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/request-password-reset']) ?>">Изменить пароль</a></li>
        <li role="presentation"><a href="<?= Url::to(['site/logout']) ?>">Выход</a></li>
    </ul>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>UID</td>
            <td><?= $user->username; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= $user->email; ?></td>
        </tr>
        <tr>
            <td>Ваше имя</td>
            <td><?= $user->name; ?></td>
        </tr>
        <tr>
            <td>Телефон</td>
            <td><?= $user->phone; ?></td>
        </tr>
        <tr>
            <td>Роль</td>
            <td><?= Yii::$app->user->identity->getRoleName() === 'admin' ? '<span class="text-danger">Администратор</span>' : '<span class="text-success">Пользователь</span>'; ?></td>
        </tr>
        <tr>
            <td>Состояние учетной записи</td>
            <td><?= $user->status === 10 ? '<span class="text-success">Активна</span>' : '<span class="text-danger">Заблокирована</span>'; ?></td>
        </tr>
        </tbody>
    </table>
</div>