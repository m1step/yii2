<?php
use yii\helpers\Url;
?>
<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th colspan="2"><h3>Заказ № <?= $order->id ?></h3></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>Заказ создан</td>
                <td><?= $order->created_at ?></td>
            </tr>
            <tr>
                <td>Количество товаров </td>
                <td><?= $order->qty ?></td>
            </tr>
            <tr>
                <td>Статус</td>
                <?php if($order->status): ?>
                    <td><span class="text-success">Выполнен</span></td>
                    <?php else: ?>
                    <td><span class="text-danger">Новый</span></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td>Имя покупателя</td>
                <td><?= $order->name ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><?= $order->email ?></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><?= $order->phone ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-responsie">
    <table class="table table-bordered">
        <thead>
            <th>Название</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </thead>
        <tbody>
        <?php foreach($items as $id => $item): ?>
            <tr>
                <td><a href="<?= Url::to(['/product/view', 'id' => $item->product_id]) ?>"><?= $item->name ?></a></td>
                <td><?= $item->price ?></td>
                <td><?= $item->qty_item ?></td>
                <td>$<?= $item->sum_item ?></td>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td colspan="3"><b>Всего на сумму: </b></td>
                <td><b>$<?= $order->sum ?></b></td>
            </tr>
        </tbody>
    </table>
</div>


