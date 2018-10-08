<?php

namespace common\repository;

use common\models\Post;
use Yii;

class PostRepository extends Repository
{
    /**
     * @var Post
     */
    protected $model;

    /**
     * CategoryRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @param $fileUpload
     * @param $categories
     *
     * @return Post
     */
    public function create($data, $fileUpload, $categories)
    {
        /** @var $model Post */
        $model = $this->instance();
        $model->title = $data['title'];
        $model->content = $data['content'];
        $model->author_id = Yii::$app->user->getId();
        if (is_string($fileUpload)) {
            $model->thumbnail = $fileUpload;
        }
        $model->save();

        foreach ($categories as $category) {
            $model->link('categories', $category);
        }

        return $model;
    }

    /**
     * @param Post $post
     * @param $data
     * @param $fileUpload
     * @param $categories
     *
     * @return Post
     */
    public function update($post, $data, $fileUpload, $categories)
    {
        /** @var $model Post */
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->author_id = Yii::$app->user->getId();
        if (is_string($fileUpload)) {
            $post->thumbnail = $fileUpload;
        }
        $post->save();
        $post->unlinkAll('categories', true);
        foreach ($categories as $category) {
            $post->link('categories', $category);
        }

        return $post;
    }


    /**
     * With lazy loading
     *
     * @param mixed ...$arg
     *
     * @return \yii\db\ActiveQuery
     */
    public function with(...$arg)
    {
        return $this->model->find()->with(...$arg);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAll()
    {
        return $this->model->find()->all();
    }
}