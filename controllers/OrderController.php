<?php

namespace app\controllers;


use app\models\Wishlist;
use Yii;
use app\models\Order;
use app\models\OrderItems;


class OrderController extends AppController
{


    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        if(!empty($session['cart'])) {
            $this->setMeta('Оформление заказа');

            $order = new Order();

            if ($order->load(Yii::$app->request->post())) {
                $order->qty = $session['cart.qty'];
                $order->sum = $session['cart.sum'];
                if(!Yii::$app->user->isGuest) {
                    $order->user_id = Yii::$app->user->identity->id;
                }
                if ($order->save()) {
                    $this->saveorderitems($session['cart'], $order->id);
                    Yii::$app->session->setFlash('success', 'Заказ принят в обработку');
                    Yii::$app->mailer->compose('order', compact('session'))
                        ->setFrom(['m1step885@gmail.com' => 'yii2.loc'])
                        ->setTo($order->email)
                        ->setSubject('Заказ')
                        ->send();
                    $session->remove('cart');
                    $session->remove('cart.qty');
                    $session->remove('cart.sum');
                    return $this->redirect(['/']);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
                    return $this->render('index', compact('session', 'order'));
                }
            }
            return $this->render('index', compact('session', 'order'));
        }else {
            return $this->goHome();
        }
    }


    protected function saveorderitems($items, $order_id)
    {
        foreach($items as $id => $item) {
            if($wish = Wishlist::findOne(['product_id' => $id, 'user_id' => Yii::$app->user->identity->id])) {
                $wish->delete();
            }
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }


}