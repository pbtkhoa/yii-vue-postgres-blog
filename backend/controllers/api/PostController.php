<?php

namespace backend\controllers\api;

use backend\business\PostBusiness;
use common\models\Post;
use yii\data\Pagination;

class PostController extends ApiController
{
    /**
     * @var PostBusiness
     */
    protected $postBusiness;

    /**
     * PostController constructor.
     *
     * @param string $id
     * @param $module
     * @param PostBusiness $postBusiness
     * @param array $config
     */
    public function __construct(string $id, $module, PostBusiness $postBusiness, array $config = [])
    {
        $this->postBusiness = $postBusiness;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $posts = $this->postBusiness->getPostApi(\Yii::$app->request->queryParams);

        return $this->arrayWithRelationShip($posts, ['categories']);
    }

    public function actionDetail($slug)
    {
        $post = $this->postBusiness->getPostBySlug($slug);

        return $this->oneWithRelationShip($post, ['categories', 'author']);
    }
}
