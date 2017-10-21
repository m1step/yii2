<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="table-responsive">
    <table class="table table-hover table-stripped">
        <thead>
        <tr>
            <td>Фото</td>
            <td>Наименование</td>
            <td>Цена</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $id => $item): ?>
            <?php $main = $item->getImage(); ?>
            <tr>
                <td><a href="<?= Url::to(['product/view', 'id' => $item['id']]) ?>"><?= Html::img($main->getUrl(), ['alt' => $item['name'], 'height' => 75])  ?></a></td>
                <td><a href="<?= Url::to(['product/view', 'id' => $item['id']]) ?>"><?= $item['name'] ?></a></td>
                <td><?= $item['price'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="2">Итого: </td>
            <td><b><?= $order->qty ?></b></td>
        </tr>
        <tr>
            <td colspan="2">На сумму: </td>
            <td><b><?= $order->sum ?></b></td>
        </tr>
        <tr>
            <td colspan="2">Статус заказа</td>
            <?php if($order->status): ?>
                <td><span class="text-success">Доставлен</span></td>
            <?php else: ?>
                <td><span class="text-danger">В обработке</span></td>
            <?php endif; ?>
        </tr>
        </tbody>
    </table>
</div>