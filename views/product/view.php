<?php

/* @var $this yii\web\View */

use \yii\helpers\Html;
use \yii\helpers\Url;
use \app\components\MenuWidget;
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ["category/{$product->category_id}"]];
$this->params['breadcrumbs'][] = $product->name;

$this->registerJs("
;( function( $ ) {

	$( '.swipebox' ).swipebox();

} )( jQuery );
");
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?= MenuWidget::widget() ?>
                    </ul><!--/category-products-->
                </div>
            </div>

            <?php
            $mainImg = $product->getImage();
            $gallery = $product->getImages();
            $i = 0;
            foreach($gallery as $img)
            {
                if($img->isMain == $mainImg->isMain)
                {
                    unset($gallery[$i]);
                    break;
                }
            }
            ?>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <?php if($mainImg->urlAlias !== 'placeHolder'): ?>
                            <a rel="gallery-1" href="<?= $mainImg->getUrl() ?>" class="swipebox">
                            <?= Html::img($mainImg->getUrl(), ['alt' => $product->name, 'width' => 310, 'height' => 240]); ?>
                            </a>
                            <?php else: ?>
                            <?= Html::img($mainImg->getUrl(), ['alt' => $product->name, 'width' => 310, 'height' => 240]); ?>
                            <?php endif; ?>
                        </div>

                        <?php if($mainImg->urlAlias !== 'placeHolder'): ?>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php $count = count($gallery); $i = 0; foreach($gallery as $img): ?>
                                    <?php if($i % 3 == 0): ?>
                                        <div class="item <?php if($i == 0) echo ' active'?>">
                                    <?php endif; ?>
                                            <a rel="gallery-1" href="<?= $img->getUrl() ?>" class="swipebox"><?= Html::img($img->getUrl(), ['alt' => '', 'width' => 84, 'height' => 85]) ?></a>
                                    <?php $i++; if($i % 3 == 0 || $i == $count): ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <?php if($gallery != null AND count($gallery) > 3): ?>
                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <?php if($product->new): ?>
                                <?= Html::img("@web/images/product-details/new.jpg", ['alt' => 'Новинка', 'class' => 'newarrival']) ?>
                            <?php endif; ?>
                            <h2><?= $product->name ?></h2>
                            <p>Артикул: <?= $product->id ?></p>
                            <span>
									<span>$<?= $product->price ?></span>
									<label for="qty">Quantity:</label>
									<input name="qwerty" value="1" id="qty"/>
									<a href="#" data-id="<?= $product->id ?>" class="btn btn-default add-to-cart cart">
										<i class="fa fa-shopping-cart"></i>
										В корзину
									</a>
								</span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Brand:</b> <a href="<?= Url::to(['category/view', 'id' => $product->category_id, 'brand' => $product->brand]) ?>"><?= $product->brand ?></a></p>
                            <?= $product->content ?>
                        </div><!--/product-information-->
                    </div>
                    <div class="clearfix"></div>
                    <h3>Комментарии:</h3>
                    <div class="tab-pane fade active in" id="reviews">
                        <div class="col-sm-12">
                            <form class="comment-form">
										<span>
                                            <?php if(Yii::$app->user->isGuest): ?>
                                                <input id="name" name="name" placeholder="Ваше имя"/>
                                                <input id="email" name="email" type="email" placeholder="Ваш Email"/>
                                            <?php else: ?>
                                                <input disabled id="name" value="<?= Yii::$app->user->identity->name; ?>"/>
                                                <input disabled id="email" name="email" value="<?= Yii::$app->user->identity->email; ?>"/>
                                            <?php endif; ?>
										</span>
                                <textarea required></textarea>
                                <input type="submit" data-id="<?= $product->id ?>" class="btn btn-default pull-right add-comment" value="Отправить">
                            </form>
                            <br />
                            <br />
                            <section id="comments">
                            <?php foreach($model as $comment): ?>
                            <ul>
                                <?= $comment->user_id != 0 ? '<li><a href="" class="disabled-href"><i class="fa fa-user"></i>' . $comment->name . '</a></li>' : '<li><a href="" class="disabled-href"><i class="fa fa-user"></i>' . $comment->name . '(гость)</a></li>'; ?>
                                <li><a href="" class="disabled-href"><i class="fa fa-calendar-o"></i><?= Yii::$app->formatter->format($comment->created_at, 'datetime'); ?></a></li>
                            </ul>
                            <p><?= $comment->text; ?></p>
                            <br />
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
                            </section>
                        </div>
                    </div>
                </div><!--/product-details-->



                <!--recommended_items--><div class="recommended_items">
                    <h2 class="title text-center">Хиты продаж</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = count($hits); $i = 0; foreach ($hits as $hit): ?>
                                <?php
                                $mainForHit = $hit->getImage();
                                ?>
                                <?php if($i % 3 == 0): ?>
                                <div class="item <?php if($i == 0) echo 'active'; ?>">
                                    <?php endif; ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="<?= Url::to(['product/view', 'id' => $hit->id]) ?>">
                                                        <?= Html::img($mainForHit->getUrl(), ['alt' => $hit->name, 'width' => 310, 'height' => 200]) ?>
                                                    </a>
                                                    <h2>$<?= $hit->price ?></h2>
                                                    <a href="<?= Url::to(['product/view', 'id' => $hit->id]) ?>"><p><?= $hit->name ?></a></p>
                                                    <a href="#" class="btn btn-default add-to-cart" data-id="<?= $hit->id ?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; if($i % 3 == 0 || $i == $count): ?>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>