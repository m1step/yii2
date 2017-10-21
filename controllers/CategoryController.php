<?php

namespace app\controllers;


use app\models\User;
use app\models\Wishlist;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;
use app\models\Category;
use app\models\Product;

class CategoryController extends AppController
{

    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $wishlist = $this->getWishList();
        }
        $hits = Product::find()->where(['hit' => 1])->limit(9)->all();
        $this->setMeta('E_SHOPPER');
        return $this->render('index', compact('hits', 'wishlist'));
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $category = Category::findOne($id);
        if(empty($category)) {
            throw new HttpException(404, 'Такой категории не существует');
        }
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $filters = [];
        foreach($products as $product) {
            if(!in_array($product->brand, $filters)) {
                $filters[] = $product->brand;
            }
        }
        $this->setMeta('E_SHOPPER | ' . $category->name, $category->keywords, $category->description);
        $minValue = $query->min('price');
        $maxValue = $query->max('price');
        if(Yii::$app->request->get('brand')) {
            $query->andWhere(['brand' => Yii::$app->request->get('brand')]);
            $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
            $products = $query->offset($pages->offset)->limit($pages->limit)->all();
            $minValue = $query->min('price');
            $maxValue = $query->max('price');
        }
        if(!Yii::$app->user->isGuest) {
            $wishlist = $this->getWishList();
        }
        return $this->render('view', compact('products', 'pages',  'category', 'filters', 'minValue', 'maxValue', 'wishlist'));
    }

    public function actionSearch()
    {

        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('E_SHOPPER | Поиск: ' . $q);
        if(!$q) {
            return $this->render('search', compact('q'));
        }
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(),'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $minValue = $query->min('price');
        $maxValue = $query->max('price');
        $filters = [];
        foreach($products as $product) {
            if(!in_array($product->brand, $filters)) {
                $filters[] = $product->brand;
            }
        }
        if(Yii::$app->request->get('brand')) {
            $query->andWhere(['brand' => Yii::$app->request->get('brand')]);
            $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
            $products = $query->offset($pages->offset)->limit($pages->limit)->all();
            $minValue = $query->min('price');
            $maxValue = $query->max('price');
        }
        if(!Yii::$app->user->isGuest) {
            $wishlist = $this->getWishList();
        }
        return $this->render('search', compact('products', 'pages', 'q', 'minValue', 'maxValue', 'filters', 'wishlist'));

    }

    public function getWishList()
    {
        $user = User::findByUsername(Yii::$app->user->identity->username);
        $wishes = $user->getProducts()->all();
        $wishlist = [];
        foreach ($wishes as $item) {
            $wishlist[] = $item->id;
        }
        return $wishlist;
    }


    public function actionAddToList()
    {
        $id = Yii::$app->request->get('id');
        $new_wish = new Wishlist();
        $new_wish->user_id = Yii::$app->user->identity->id;
        $new_wish->product_id = $id;
        $new_wish->save();
    }


    public function actionRemoveFromList()
    {
        $id = Yii::$app->request->get('id');
        $wish = Wishlist::findOne(['user_id' => Yii::$app->user->identity->id, 'product_id' => $id]);
        $wish->delete();
    }


}