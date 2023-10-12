<?php

namespace app\controllers\alatech\api;

use app\base\BaseController;
use app\models\authorization\Login;
use app\models\authorization\User;
use Yii;
use yii\filters\VerbFilter;

class LoginController extends BaseController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] =
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['POST'],
                ]
            ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $model = new Login();
        if($model->load(Yii::$app->request->post(), '') && $model->validate())
        {
            $user = User::findOne(['username' => $model->username]);
            if($user != null) {
                if(strlen($user->accessToken) > 0) {
                    Yii::$app->response->statusCode = 403;
                    $model->addError('*', 'Already logged in');
                    return $model->errors;
                }
                else if($user->password == $model->password) {
                    $user->refreshAccessToken();
                    $user->save();
                    Yii::$app->user->login($user);
                    return [
                        'token' => $user->accessToken,
                    ];
                }
            }
            Yii::$app->response->statusCode = 400;
            $model->addError('*', 'Invalid credentials');
            return $model->errors;
        }
        Yii::$app->response->statusCode = 400;
        return $model->errors;
    }
}
