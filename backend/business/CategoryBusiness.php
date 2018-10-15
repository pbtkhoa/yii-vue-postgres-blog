<?php

namespace backend\business;

use common\repository\CategoryRepository;

class CategoryBusiness extends Business
{
    const DESC = 'DESC';
    const ASC = 'ASC';
    const PAGE_LIMIT = 2;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * PostBusiness constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get All category
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getListCategoryApi()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get Category By Slug
     *
     * @param $slug
     * @param array $queryParams
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getCategoryApiBySlug($slug, $queryParams = [])
    {
        $postQuery = $this->categoryRepository->with(['posts' => function ($query) use ($queryParams) {
            $this->queryOrderBy($query, $queryParams, 'created_at');
            $this->queryLimit($query, $queryParams);
            $this->queryPaginate($query, $queryParams);
        }])->where(['slug' => $slug]);

        return $postQuery->one();
    }

    /**
     * Query order By
     *
     * @param \yii\db\ActiveQuery $query
     * @param array $queryParams
     * @param $column
     *
     * @return \yii\db\ActiveQuery
     */
    private function queryOrderBy($query, $queryParams, $column)
    {
        if (isset($queryParams[$column])) {
            $queryValue = strtoupper($queryParams[$column]);
            if ($this->isValidOrder($queryValue)) {
                $query = $query->orderBy("$column $queryValue");
            }
        }

        return $query;
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
     * Query Limit
     *
     * @param \yii\db\ActiveQuery $query
     * @param array $queryParams
     *
     * @return \yii\db\ActiveQuery
     */
    private function queryLimit($query, $queryParams)
    {
        if (isset($queryParams['limit'])) {
            $limit = $queryParams['limit'];
            if (is_numeric($limit)) {
                $query = $query->limit($limit);
            }
        }

        return $query;
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