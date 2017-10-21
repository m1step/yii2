<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->registerJs("
;( function( $ ) {

	$( '.swipebox' ).swipebox();

} )( jQuery );
");
$this->registerCss('
.reshenie_image_form{
    display: block;
    opacity: 1;
    -webkit-transform: scale(1,1);
    -webkit-transition-timing-function: ease-out;
    -webkit-transition-duration: 550ms;
    -moz-transform: scale(1,1);
    -moz-transition-timing-function: ease-out;
    -moz-transition-duration: 550ms;
}
.reshenie_image_form:hover{
    -webkit-transform: scale(1.2,1.2);
    -webkit-transition-timing-function: ease-out;
    -webkit-transition-duration: 550ms;
    -moz-transform: scale(1.2,1.2);
    -moz-transition-timing-function: ease-out;
    -moz-transition-duration: 550ms;
}
');
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    $img = $model->getImage();
    $gallery = $model->getImages();
    $img2s = '<div class="view-product">';
    foreach($gallery as $img2)
    {
        if($img2->isMain != $img->isMain)
        {
            $url = Url::toRoute(['product/delete-image', 'model' => $model->id, 'id_img' => $img2->id]);
            $url1 = Url::toRoute(['product/change-main-image', 'model' => $model->id, 'id_img' => $img2->id]);
            $img2s .= "<div class='col-xs-6 col-md-3'><div  class='thumbnail reshenie_image_form'><a class='btn delete_img' href={$url} data-id={$img2->id}>
<span class='glyphicon glyphicon-remove'></span></a><a href=$url1><span class='glyphicon glyphicon-menu-right'></span></a><a class='fancybox img-rounded swipebox' href={$img2->getUrl()}>" .
                Html::img($img2->getUrl(), ['alt' => $model->name]) . '</a></div></div>';
        }

    }
    $img2s .= '</div>';
    if($img2s == '<div class="view-product"></div>')
    {
        $img2s = '<div class="view-product">null</div>';
    }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name;
                }
            ],
            'name',
            'content:html',
            'price',
            'brand',
            'keywords',
            'description',
            [
                'attribute' => 'image',
                'value' => "<img src='{$img->getUrl()}'>",
                'format' => 'html',
            ],
            [
                  'attribute' => 'gallery',
                'value' => $img2s,
                'format' => 'html'
            ],
            [
                'attribute' => 'hit',
                'value' => function($data) {
                    return !$data->hit ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'new',
                'value' => function($data) {
                    return !$data->new ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'sale',
                'value' => function($data) {
                    return !$data->sale ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html'
            ],
        ],
    ]) ?>

</div>
