<?php

namespace app\models;


use rico\yii2images\models\Image;
use yii\db\ActiveRecord;


class Product extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public static function tableName()
    {
        return 'product';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }


    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['product_id' => 'id']);
    }

}