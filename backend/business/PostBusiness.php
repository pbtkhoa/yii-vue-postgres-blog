<?php

namespace backend\business;

use common\models\Post;
use common\repository\CategoryRepository;
use common\repository\PostRepository;

class PostBusiness extends Business
{
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
     * Get Post by slug
     *
     * @param $slug
     *
     * @return array|null|\yii\db\ActiveRecord|Post
     */
    public function getPostBySlug($slug)
    {
        return $this->postRepository->with(['categories'])->where(['slug' => $slug])->one();
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
}