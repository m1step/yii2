<?php

namespace app\models;


use yii\db\ActiveRecord;


/**
 * Class Category
 *
 * @property $id int
 * @property $parent_id int
 * @property $name string
 * @property $keywords string
 * @property $description string
 *
 * @property $products Product[]
 *
 * @package app\models
 */
class Category extends ActiveRecord
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
        return 'category';
    }

    public function getProducts()
    {
        return $this->hasMany(Product::classname(), ['category_id' => 'id']);
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'ID родителя',
            'name' => 'Название',
            'keywords' => 'Ключевые слова',
            'description' => 'Мета-описание'
        ];
    }


}