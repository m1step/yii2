<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use \yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\components\LoginFormWidget;

AppAsset::register($this);
$this->registerJs("
    jQuery(document).ready(function($){
        $.iMissYou({
            title: 'Вернись...',
            favicon: {
                enabled: true,
                src:'/images/ico/iMissYouFavicon.ico'
            }
        });
    });
");
$this->registerJsFile('@web/js/counter/ovc/counter.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerJsFile('js/html5shiv.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
    $this->registerJsFile('js/respond.min.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
    ?>
    <link rel="shortcut icon" href="/images/ico/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<?php $this->beginBody() ?>
<?= (Yii::$app->user->isGuest ? LoginFormWidget::widget([]) : ''); ?>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="viber://chat?number=+380634553276"><i class="fa fa-phone"></i> +38 (063) 455 32 76</a></li>
                            <li><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=m1step885@gmail.com" target="_blank"><i class="fa fa-envelope"></i> m1step885@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/?lang=ru" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://vk.com/m1step" target="_blank"><i class="fa fa-vk"></i></a></li>
                            <li><a href="https://plus.google.com/114176305974770552670" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?= Url::home() ?>"><?= Html::img('@web/images/home/logo.png', ['alt' => 'E_SHOPPER']) ?></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= Url::to(['site/about']) ?>"><i class="fa fa-user"></i>О нас</a></li>
                            <li><a href="<?= Url::to(['cart/view']) ?>"><i class="fa fa-shopping-cart"></i> Корзина</a></li>
                            <?php if(!Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Url::to(['site/logout']) ?>"><i class="fa fa-user"></i><?= Yii::$app->user->identity->name ?> (Выход)</a></li>
                                <?php if(Yii::$app->user->identity->getRoleName() == 'admin'): ?>
                                    <li><a href="<?= Url::to(['/admin']) ?>"><i class="fa fa-user"></i>Админ-панель</a></li>
                                    <?php else: ?>
                                        <li><a href="<?= Url::to(['profile/index']) ?>"><i class="fa fa-user"></i>Личный кабинет</a></li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li data-toggle="modal" data-target="#login-modal"><a href="#"><i class="fa fa-eye"></i>Войти</a></li>
                                <li><a href="<?= Url::to(['site/signup']) ?>"><i class="fa fa-user"></i>Регистрация</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="container">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span>&times;</span></button>
                <?= Yii::$app->session->getFlash('success') ?>

            </div>
        </div>
    <?php endif; ?>
    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="container">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span>&times;</span></button>
                <?= Yii::$app->session->getFlash('error') ?>

            </div>
        </div>
    <?php endif; ?>
    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <div class="d1">
                            <form action="<?= Url::to(['category/search'])?>">
                                <input placeholder="Искать здесь..." name="q">
                                <button></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
<section id="main">
<?= $content ?>
</section>
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <a href="<?= Url::home() ?>"><h2><span>e</span>-shopper</h2></a>
                        <p>Короткое описание интернет-магазина</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe1.png" alt="" />
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe2.png" alt="" />
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe3.png" alt="" />
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe4.png" alt="" />
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1635.8326398699191!2d30.726379426531288!3d46.40644614729211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1500480974570"
                                width="300" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="<?= Url::to('site/contact'); ?>">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Privecy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="<?= Url::to('site/about'); ?>">Company Information</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">© <?= date('Y') ?> <?= Yii::powered() ?> + E-shopper. All rights reserved.</p>
                <p class="pull-right"><span id="time">Дата и время</span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2 align="center">Корзина</h2>',
    'id' => 'cart',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
        <a href="' . \yii\helpers\Url::to(['cart/view']) . '" class="btn btn-success">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>',
]);

\yii\bootstrap\Modal::end();
?>

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2 align="center">Товары</h2>',
    'id' => 'items',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">ОК</button>',
]);

\yii\bootstrap\Modal::end();
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>