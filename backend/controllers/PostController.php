<?php

namespace backend\controllers;

use backend\business\PostBusiness;
use common\models\Category;
use common\models\Post;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class PostController extends Controller
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
        $posts = $this->postBusiness->getAllDetailPost();

        return $this->render('index', compact('posts'));
    }

    public function actionCreate()
    {
        $model = new Post();
        $categories = $this->postBusiness->getAllCategory();
        $dataRequest = Yii::$app->request->post();
        if (Yii::$app->request->isPost && $model->load($dataRequest)) {
            $model->thumbnail = UploadedFile::getInstance($model, 'thumbnail');
            if ($fileUpload = $model->upload()) {
                $this->postBusiness->createPost($dataRequest, $fileUpload);

                return $this->refresh();
            }
        }

        return $this->render('create', compact('model', 'categories'));
    }

    public function actionEdit($id)
    {
        $model = $this->postBusiness->getPostById($id);
        $categories = $this->postBusiness->getAllCategory();
        $dataRequest = Yii::$app->request->post();
        if (Yii::$app->request->isPost && $model->load($dataRequest)) {
            $file = UploadedFile::getInstance($model, 'thumbnail');
            if (is_null($file)) {
                if ($model->validate($dataRequest)) {
                    $model->thumbnail = $model->getOldAttribute('thumbnail');
                    $this->postBusiness->updatePost($model, $dataRequest, null);

                    return $this->refresh();
                }
            } else {
                $model->thumbnail = $file;
                if ($fileUpload = $model->upload()) {
                    $this->postBusiness->updatePost($model, $dataRequest, $fileUpload);

                    return $this->refresh();
                }
            }
        }

        return $this->render('edit', compact('model', 'categories'));
    }

    public function actionCategory()
    {
        $model = new Category();
        $dataRequest = Yii::$app->request->post();
        if ($model->load($dataRequest) && $model->validate()) {
            $this->postBusiness->createCategory($dataRequest);

            return $this->refresh();
        } else {
            $categories = $this->postBusiness->getAllCategory();

            return $this->render('category', compact('model', 'categories'));
        }
    }
}
