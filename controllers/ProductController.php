<?php
/**
 * Created by PhpStorm.
 * User: WORK-PC
 * Date: 10.07.2017
 * Time: 22:02
 */

namespace app\controllers;


use app\models\Comment;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;


class ProductController extends AppController
{


    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if(empty($product)) {
            throw new HttpException(404, 'Такого товара нет');
        }
        $comments = $product->getComments();
        $pages = new Pagination(['totalCount' => $comments->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $model = $comments->offset($pages->offset)->limit($pages->limit)->orderBy(['created_at' => SORT_DESC])->all();
        $hits = Product::find()->where(['hit' => 1])->limit(9)->all();
        $this->setMeta('E_SHOPPER | ' . $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product', 'hits', 'model', 'pages'));
    }


    public function actionAddComment()
    {
        $model = new Comment();
        if(Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                $model->name = Yii::$app->request->get('name');
                $model->email = Yii::$app->request->get('email');
                $model->user_id = 0;
            } else {
                $model->name = Yii::$app->user->identity->name;
                $model->user_id = Yii::$app->user->identity->id;
            }
            $model->text = Yii::$app->request->get('text');
            $model->product_id = Yii::$app->request->get('id');
            $model->parent_id = 0;
            if($model->save()) {
                return true;
            }
        }
        return false;
    }


}