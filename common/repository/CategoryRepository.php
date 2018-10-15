<?php

namespace common\repository;

use common\models\Category;

class CategoryRepository extends Repository
{
    /**
     * @var Category
     */
    protected $model;

    /**
     * CategoryRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     *
     * @return Category
     */
    public function create($data)
    {
        /** @var $model Category */
        $model = $this->instance();
        $model->title = $data['title'];
        $model->description = $data['description'];
        $model->save();

        return $model;
    }

    /**
     * @param $condition
     * @param array $params
     *
     * @return \yii\db\ActiveQuery
     */
    public function where($condition, $params = [])
    {
        return $this->model->find()->where($condition, $params);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAll()
    {
        return $this->model->find()->all();
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
}