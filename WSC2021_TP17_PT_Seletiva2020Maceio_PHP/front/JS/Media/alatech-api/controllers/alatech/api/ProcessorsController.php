<?php

namespace app\controllers\alatech\api;

use app\base\BaseController;
use app\models\Processor;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\auth\HttpBearerAuth;

class ProcessorsController extends BaseController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $dataProvider = new ActiveDataProvider();
        $dataProvider->query = Processor::find();
        $dataProvider->pagination = new Pagination([
            'params' => [
                'page' => intval($queryParams['page'] ?? 1),
                'per-page' => intval($queryParams['pageSize'] ?? 10)
            ],
            'validatePage' => false
        ]);
        return $dataProvider;
    }
}
