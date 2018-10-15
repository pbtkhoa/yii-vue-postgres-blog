<?php

namespace backend\business;

use common\models\Post;
use common\repository\CategoryRepository;
use common\repository\PostRepository;

class PostBusiness extends Business
{
    const DESC = 'DESC';
    const ASC = 'ASC';
    const PAGE_LIMIT = 2;

    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * PostBusiness constructor.
     *
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create Post
     *
     * @param array $data
     * @param string $fileUpload
     *
     * @return \common\models\Post
     */
    public function createPost(array $data, $fileUpload)
    {
        $dataPost = $data['Post'];
        $categories = [];
        if (!empty($dataPost['categories'])) {
            $categories = $this->categoryRepository->where(['in', 'id', $dataPost['categories']])->all();
        }

        return $this->postRepository->create($dataPost, $fileUpload, $categories);
    }

    /**
     * Create Post
     *
     * @param Post $post
     * @param array $data
     * @param string $fileUpload
     *
     * @return \common\models\Post
     */
    public function updatePost($post, array $data, $fileUpload)
    {
        if (is_null($post)) {
            return $post;
        }

        $dataPost = $data['Post'];
        $categories = [];
        if (!empty($dataPost['categories'])) {
            $categories = $this->categoryRepository->where(['in', 'id', $dataPost['categories']])->all();
        }

        return $this->postRepository->update($post, $dataPost, $fileUpload, $categories);
    }

    /**
     * Get All Post
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAllDetailPost()
    {
        return $this->postRepository->with(['author', 'categories'])->all();
    }

    /**
     * Get All Post
     *
     * @return array|\yii\db\ActiveRecord[]
     *
     * @param array $queryParams
     */
    public function getPostApi($queryParams = [])
    {
        $postQuery = $this->postRepository->with(['author', 'categories']);

        $postQuery = $this->queryPaginate($postQuery, $queryParams);
        $postQuery = $this->queryOrderBy($postQuery, $queryParams, 'created_at');
        $postQuery = $this->queryOrderBy($postQuery, $queryParams, 'view');

        return $postQuery->all();
    }

    /**
     * Get Post By Slug
     *
     * @param $slug
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getPostBySlug($slug)
    {
        $postQuery = $this->postRepository->with(['author', 'categories'])->where(['slug' => $slug]);

        return $postQuery->one();
    }

    /**
     * Get Post by id
     *
     * @param $id
     *
     * @return array|null|\yii\db\ActiveRecord|Post
     */
    public function getPostById($id)
    {
        return $this->postRepository->with(['categories'])->where(['id' => $id])->one();
    }

    /**
     * Get All category
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAllCategory()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Create category
     *
     * @param array $data
     *
     * @return \common\models\Category
     */
    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data['Category']);
    }

    /**
     * Query paginate
     *
     * @param \yii\db\ActiveQuery $query
     * @param array $queryParams
     *
     * @return \yii\db\ActiveQuery
     */
    private function queryPaginate($query, $queryParams)
    {
        if (isset($queryParams['page'])) {
            $page = $queryParams['page'];
            if (is_numeric($page) && $page > 0) {
                $query = $query->limit(self::PAGE_LIMIT)
                    ->offset(self::PAGE_LIMIT * $page - self::PAGE_LIMIT);
            }
        }

        return $query;
    }

    /**
     * Query order By
     *
     * @param \yii\db\ActiveQuery $postQuery
     * @param array $queryParams
     * @param $column
     *
     * @return \yii\db\ActiveQuery
     */
    private function queryOrderBy($postQuery, $queryParams, $column)
    {
        if (isset($queryParams[$column])) {
            $queryValue = strtoupper($queryParams[$column]);
            if ($this->isValidOrder($queryValue)) {
                $postQuery = $postQuery->orderBy("$column $queryValue");
            }
        }

        return $postQuery;
    }

    /**
     * Check is valid param order
     *
     * @param $queryParam
     *
     * @return bool
     */
    private function isValidOrder($queryParam)
    {
        return in_array($queryParam, [self::ASC, self::DESC]);
    }
}