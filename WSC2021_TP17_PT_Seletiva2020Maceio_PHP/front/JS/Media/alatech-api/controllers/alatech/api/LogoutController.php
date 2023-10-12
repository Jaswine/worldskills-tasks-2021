<?php

namespace app\controllers\alatech\api;

use app\base\BaseController;
use app\models\authorization\Logout;
use app\models\authorization\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;

class LogoutController extends BaseController
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
                'index' => ['POST'],
            ]
        ];
        return $behaviors;
    }

    public function actionIndex() {
        $model = new Logout();
        if(!Yii::$app->user->isGuest)
        {
            $model->token = Yii::$app->user->getIdentity()->accessToken;
            if($model->validate()) {
                $user = User::findIdentity(Yii::$app->user->getId());
                if($user != null) {
                    if (strlen($user->accessToken) > 0) {
                        $user->accessToken = '';
                        $user->save();
                        return [
                            'message' => 'Logout successful'
                        ];
                    } else {
                        Yii::$app->response->statusCode = 404;
                        $model->addError('token', 'Not logged in');
                        return $model->errors;
                    }
                }
            }
            Yii::$app->response->statusCode = 404;
            $model->addError('token', 'Invalid token');
            return $model->errors;
        }
        Yii::$app->response->statusCode = 400;
        $model->addError('*', 'No token supplied');
        return $model->errors;
    }
}
