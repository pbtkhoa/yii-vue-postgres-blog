<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class Post extends ActiveRecord
{
    const UPLOAD_DIR = 'uploads/posts/:timestamp_:name.:ext';

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['thumbnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
     * Upload file
     *
     * @return bool|null|string
     */
    public function upload()
    {
        if (!is_null($this->thumbnail)) {
            $fileUpload = str_replace([':timestamp', ':name', ':ext'],
                [time(), $this->thumbnail->baseName, $this->thumbnail->extension],
                self::UPLOAD_DIR
            );
            $this->thumbnail->saveAs($fileUpload);

            return Url::base(true) . '/' . $fileUpload;
        }

        return null;
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

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('post_category', ['post_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}