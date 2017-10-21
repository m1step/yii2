<?php

/* @var $this yii\web\View */

use \yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = $category->name;
if(Yii::$app->request->get('brand'))
{
    $this->params['breadcrumbs'][] = Yii::$app->request->get('brand');
}
?>
<section id="advertisement">
    <div class="container">
        <img src="/images/shop/advertisement.jpg" alt="" />
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuWidget::widget() ?>
                    </ul><!--/category-products-->
                    <?php if(!empty($products)): ?>
                    <!--brands_products--><div class="brands_products">
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">

                                <?php foreach($filters as $filter): ?>
                                <li><a href="<?= Url::to(['category/view', 'id' => $category->id, 'brand' => $filter]) ?>"><?= $filter ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well">
                            <input class="span2" value="" data-slider-min="<?= $minValue ?>" data-slider-max="<?= $maxValue ?>" data-slider-step="5" data-slider-value="[<?= $minValue ?>,<?= $maxValue ?>]" id="sl2" ><br />
                            <b>$ <?= $minValue ?></b> <b class="pull-right">$ <?= $maxValue ?></b>
                        </div>
                    </div><!--/price-range-->
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?= $category->name ?></h2>
                    <?php if(!empty($products)): ?>
                        <?php $i = 0; foreach ($products as $product): ?>
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
                                    <a href="#" data-id="<?= $product->id ?>" class="btn btn-default add-to-cart cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        В корзину
                                    </a>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <?php if(Yii::$app->user->isGuest): ?>
                                            <li data-toggle="modal" data-target="#login-modal"><a href="#"><i class="fa fa-plus-square"></i>Добавить в список желаний</a></li>
                                        <?php elseif(\yii\helpers\ArrayHelper::isIn($product->id, $wishlist)): ?>
                                            <li><a href="#" class="remove-from-list" data-id="<?= $product->id; ?>"><i class="fa fa-minus-square"></i>Удалить из списка желаний</a></li>
                                        <?php else: ?>
                                            <li><a href="#" class="add-to-list" data-id="<?= $product->id; ?>"><i class="fa fa-plus-square"></i>Добавить в список желаний</a></li>
                                        <?php endif; ?>
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
                        <div class="clearfix"></div>
                        <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
                        <?php else: ?>
                        <h2>Здесь пока нет товаров</h2>
                    <?php endif; ?>

                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

