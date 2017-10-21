<?php



namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class OrderItems extends ActiveRecord
{

    public static function tableName()
    {
        return 'order_items';
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }


}