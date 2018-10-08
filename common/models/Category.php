<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true
            ]
        ];
    }

    /**
     * @param $slug
     *
     * @return null|static
     */
    public static function findBySlug($slug)
    {
        return static::findOne([
            'slug' => $slug
        ]);
    }
}