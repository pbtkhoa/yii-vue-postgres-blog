<?php

namespace backend\controllers\api;

use backend\business\CategoryBusiness;

class CategoryController extends ApiController
{
    protected $categoryBusiness;

    /**
     * CategoryController constructor.
     *
     * @param string $id
     * @param $module
     * @param CategoryBusiness $categoryBusiness
     * @param array $config
     */
    public function __construct(string $id, $module, CategoryBusiness $categoryBusiness, array $config = [])
    {
        $this->categoryBusiness = $categoryBusiness;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->categoryBusiness->getListCategoryApi();
    }

    public function actionDetail($slug)
    {
        $post = $this->categoryBusiness->getCategoryApiBySlug($slug, \Yii::$app->request->queryParams);

        return $this->oneWithRelationShip($post, ['posts']);
    }
}
