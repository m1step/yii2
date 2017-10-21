<?php

/**
 * @var $this yii\web\View 
 * @var $hits \app\models\Product[]
 * @var $mainImg \rico\yii2images\models\Image
*/

use \yii\helpers\Html;
?>
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>100% Responsive Design</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free Ecommerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuWidget::widget() ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9 padding-right">

                <?php if(!empty($hits)): ?>
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Хиты продаж</h2>
                    <?php $i = 0; foreach($hits as $hit):  ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <?php $mainImg = $hit->getImage(); ?>
                                    <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit->id]) ?>">
                                        <?= Html::img($mainImg->getUrl(), ['alt' => $hit->name, 'width' => 310, 'height' => 200]) ?>
                                    </a>
                                    <h2>$<?= $hit->price; ?></h2>
                                    <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit->id]) ?>"><?= $hit->name ?></a></p>
                                    <a href="#" data-id="<?= $hit->id ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <?php if(Yii::$app->user->isGuest): ?>
                                            <li data-toggle="modal" data-target="#login-modal"><a href="#"><i class="fa fa-plus-square"></i>Добавить в список желаний</a></li>
                                        <?php elseif(\yii\helpers\ArrayHelper::isIn($hit->id, $wishlist)): ?>
                                            <li><a href="#" class="remove-from-list" data-id="<?= $hit->id; ?>"><i class="fa fa-minus-square"></i>Удалить из списка желаний</a></li>
                                        <?php else: ?>
                                            <li><a href="#" class="add-to-list" data-id="<?= $hit->id; ?>"><i class="fa fa-plus-square"></i>Добавить в список желаний</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <?php if($hit->new AND $mainImg->urlAlias !== 'placeHolder'): ?>
                                    <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                                <?php endif; ?>
                                <?php if($hit->sale AND $mainImg->urlAlias !== 'placeHolder'): ?>
                                    <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div><!--features_items-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
