<?php

namespace app\base;

use Yii;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class BaseActiveController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $freshBehaviors = [];
        $freshBehaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => [],
            ]
        ];
        $results = ArrayHelper::merge($freshBehaviors, $behaviors);
        return $results;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        parent::checkAccess($action, $model, $params);
        if(!Yii::$app->user->isGuest && Yii::$app->user->getIdentity()->isNewRecord)
        {
            throw new ForbiddenHttpException('You are not allowed to perform this operation');
        }
    }

    public function beforeAction($action)
    {
        $value = parent::beforeAction($action);
        $this->checkAccess($this->action->id);
        return $value;
    }
}
