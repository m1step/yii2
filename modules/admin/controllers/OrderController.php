<?php

namespace app\modules\admin\controllers;


use Yii;
use app\modules\admin\models\Order;
use yii\data\Pagination;

class OrderController extends AppAdminController
{

    public function actionIndex()
    {
        $orders = Order::find();
        $pages = new Pagination(['totalCount' => $orders->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $order = $orders->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('order', 'pages'));
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $order = Order::findOne($id);
        $items = $order->getOrderItems()->all();

        return $this->render('view', compact('order', 'items'));
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        Order::findOne($id)->delete();
        Yii::$app->db->createCommand("DELETE FROM order_items WHERE order_id = '$id'")->execute();
        Yii::$app->session->setFlash('success', 'Заказ удален');

        return $this->redirect(['order/index']);
    }

    public function actionChange()
    {
        $id = Yii::$app->request->get('id');

        $order = new Order();
        $orderToUpdate = Order::findOne($id);
        if ($orderToUpdate->load(Yii::$app->request->post()))
        {
            if($orderToUpdate->save())
            {
                Yii::$app->session->setFlash('success', 'Закан отредактирован');
                return $this->redirect(['order/index']);
            }
        }

        return $this->render('change', compact('order', 'orderToUpdate'));
    }

}