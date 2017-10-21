<?php
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

    Здравствуйте, <?= $user->username ?>,
    Пройдите по ссылке для создания/восстановления пароля:

<?= $resetLink ?>