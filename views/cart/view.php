<?php

use yii\helpers\Url;

$this->params['breadcrumbs'][] = 'Корзина';
?>
<div class="container">
    <?php if(!empty($session['cart'])): ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image"></td>
                    <td class="description  ">Наименование</td>
                    <td class="quantity">Количество</td>
                    <td class="price">Цена</td>
                    <td class="total">Сумма</td>
                    <td style="width: 80px"></td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td class="cart_product"><?= \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 75])  ?></td>
                        <td class="cart_description"><h4><a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></h4><p>Артикул: <?= $id ?></p></td>
                        <td class="cart_quantity"><p><?= $item['qty'] ?></p></td>
                        <td class="cart_price"><p>$<?= $item['price'] ?></p></td>
                        <td class="cart_total"><p class="cart_total_price">$<?= $item['qty'] * $item['price'] ?></p></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item-cart" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><p style="font-size: 20px;">Итого: </p></td>
                    <td><p style="font-size: 17px; font-weight: bold;"><?= $session['cart.qty'] ?></p></td>
                </tr>
                <tr>
                    <td colspan="5"><p style="font-size: 25px;">На сумму: </p></td>
                    <td><p style="font-size: 20px; font-weight: bold;">$<?= $session['cart.sum'] ?></p></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <br />
            <a href="<?= Url::to(['order/index']) ?>"><button type="button" class="btn btn-success">Оформить заказ</button></a>
        </div>
            <br />
    <?php else: ?>
        <br />
        <p align="center" style="font-size: xx-large;">Корзина пустая</p>
        <br />
    <?php endif; ?>
</div>
<section id="advertisement">
    <div class="container">
        <img src="/images/shop/advertisement.jpg" alt="" />
    </div>
</section>
