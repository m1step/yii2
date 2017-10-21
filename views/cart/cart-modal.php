<?php if(!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-stripped">
            <thead>
            <tr>
                <td>Фото</td>
                <td>Наименование</td>
                <td>Количество</td>
                <td>Цена</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <td><?= \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 75])  ?></td>
                    <td><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Итого: </td>
                <td><b><?= $session['cart.qty'] ?></b></td>
            </tr>
            <tr>
                <td colspan="4">На сумму: </td>
                <td><b><?= $session['cart.sum'] ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <h3>Корзина пустая</h3>
<?php endif; ?>
