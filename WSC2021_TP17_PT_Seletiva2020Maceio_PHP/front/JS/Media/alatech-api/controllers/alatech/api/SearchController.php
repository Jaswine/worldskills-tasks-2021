<?php

namespace app\controllers\alatech\api;

use app\base\BaseController;
use app\models\PowerSupply;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;

class SearchController extends BaseController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authorization'] = [
            'class' => HttpBearerAuth::class,
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['GET'],
            ]
        ];
        return $behaviors;
    }

    private function getCategoryClassName($category)
    {
        $categories = [
            'motherboards' => 'Motherboard',
            'processors' => 'Processor',
            'ram-memories' => 'RamMemory',
            'storage-devices' => 'StorageDevice',
            'graphic-cards' => 'GraphicCard',
            'power-supplies' => 'PowerSupply',
            'machines' => 'Machine'
        ];
        if(!isset($categories[$category]))
        {
            throw new Exception('Invalid category name');
        }
        return 'app\models\\' . $categories[$category];
    }

    public function actionIndex($category)
    {
        try {
            $categoryClassName = $this->getCategoryClassName($category);
            $queryParams = Yii::$app->request->getQueryParams();
            $querySearch = $queryParams['q'] ?? '';
            /** @var ActiveQuery $query */
            $query = $categoryClassName::find();
            $query->where(['like', 'name', $querySearch]);
            // Creating data provider
            $dataProvider = new ActiveDataProvider();
            $dataProvider->query = $query;
            $dataProvider->pagination = new Pagination([
                'params' => [
                    'page' => intval($queryParams['page'] ?? 1),
                    'per-page' => intval($queryParams['pageSize'] ?? 10)
                ],
                'validatePage' => false
            ]);
            // Returning data provider will cause the query to execute
            return $dataProvider;
        } catch (Exception $exception) {
            Yii::$app->response->statusCode = 400;
            return [
                'message' => 'Invalid category name'
            ];
        }
    }
}
