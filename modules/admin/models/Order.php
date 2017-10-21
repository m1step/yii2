<?php


namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class Order extends ActiveRecord
{

    public static function tableName()
    {
        return 'order';
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'adress'], 'required'],
            [['created_at'], 'safe'],
            [['qty'], 'integer'],
            [['sum'], 'number'],
            [['status'], 'boolean'],
            [['name', 'email', 'phone', 'adress'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'status' => 'Статус заказа',
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'adress' => 'Адресс',
        ];
    }

}