<?php

namespace backend\controllers\api;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    /**
     * ApiController constructor.
     *
     * @param string $id
     * @param $module
     * @param array $config
     */
    public function __construct(string $id, $module, array $config = [])
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        return $behaviors;
    }

    /**
     * With Relation Ship
     *
     * @param $listModels
     * @param array $relations
     *
     * @return array
     */
    protected function arrayWithRelationShip($listModels, array $relations = [])
    {
        $modelsData = ArrayHelper::toArray($listModels);
        if (empty($relations)) {
            return $modelsData;
        }

        foreach ($listModels as $index => $model) {
            foreach ($relations as $relation) {
                $modelRelation = $model->{$relation} ?? null;
                if (!empty($modelRelation)) {
                    $modelsData[$index][$relation] = $modelRelation;
                }
            }
        }

        return $modelsData;
    }

    /**
     * With Relation Ship
     *
     * @param $model
     * @param array $relations
     *
     * @return array
     */
    protected function oneWithRelationShip($model, array $relations = [])
    {
        $modelData = ArrayHelper::toArray($model);
        if (empty($relations)) {
            return $modelData;
        }

        foreach ($relations as $relation) {
            $modelRelation = $model->{$relation} ?? null;
            if (!empty($modelRelation)) {
                $modelData[$relation] = $modelRelation;
            }
        }

        return $modelData;
    }
}
