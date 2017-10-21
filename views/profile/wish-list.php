<?php
use yii\helpers\Url;
use \yii\helpers\Html;
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
    <div class="features_items"><!--features_items-->
        <br />
        <h2 class="title text-center">Список моих желаний</h2>
        <?php if(!empty($wishes)): ?>
            <?php $i = 0; foreach ($wishes as $product): ?>
                <?php $mainImg = $product->getImage(); ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>">
                                    <?= Html::img($mainImg->getUrl(), ['alt' => $product->name, 'width' => 310, 'height' => 200]) ?>
                                </a>
                                <h2>$<?= $product->price ?></h2>
                                <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"><?= $product->name ?></a></p>
                                <a href="#" data-id="<?= $product->id ?>" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    В корзину
                                </a>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                        <li><a href="#" class="remove-from-profile-list" data-id="<?= $product->id; ?>"><i class="fa fa-minus-square"></i>Удалить из списка желаний</a></li>
                                    </ul>
                            </div>
                            <?php if($product->new AND $mainImg->urlAlias !== 'placeHolder'): ?>
                                <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                            <?php endif; ?>
                            <?php if($product->sale AND $mainImg->urlAlias !== 'placeHolder'): ?>
                                <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php $i++ ?>
                <?php if($i % 3 == 0): ?>
                    <div class="clearfix"></div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <h2 align="center">Список желаний пуст</h2>
        <?php endif; ?>

    </div><!--features_items-->
</div>