<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
<?php if(!empty($order)): ?>
    <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>№ заказа</th>
                        <th>Создан</th>
                        <th>Имя покупателя</th>
                        <th>Кол-во товаров</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                    <td colspan="7" style="background: grey"></td>
                </tr>
                <?php foreach($order as $id => $item): ?>
                <tr>
                    <td style="vertical-align: middle;"><?= $item->id ?></td>
                    <td style="vertical-align: middle;"><?= $item->created_at ?></td>
                    <td style="vertical-align: middle;"><?= $item->name ?></td>
                    <td style="vertical-align: middle;"><?= $item->qty ?></td>
                    <td style="vertical-align: middle;">$<?= $item->sum ?></td>
                    <?php if($item->status): ?>
                        <td style="vertical-align: middle;"><span class="text-success">Выполнен</span></td>
                        <?php else: ?>
                        <td style="vertical-align: middle;"><span class="text-danger">Новый</span></td>
                    <?php endif; ?>
                    <td><a href="<?= Url::to(['order/view', 'id' => $item->id]) ?>">Просмотр</a><br />
                        <a href="<?= Url::to(['order/change', 'id' => $item->id]) ?>">Редактировать</a><br />
                        <a href="<?= Url::to(['order/delete', 'id' => $item->id]) ?>" class="admin-delete-item" onclick="return confirm('Точно удалить?')" data-id="<?= $item->id ?>">Удалить</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        <div class="clearfix"></div>
        <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>
<?php else: ?>
    <p align="center" style="font-size: xx-large;">Еще никто ничего не заказал...</p>
    <br />
<?php endif; ?>
