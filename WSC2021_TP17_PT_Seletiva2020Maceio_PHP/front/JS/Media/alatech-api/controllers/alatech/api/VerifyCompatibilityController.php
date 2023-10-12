<?php

namespace app\controllers\alatech\api;

use app\base\BaseController;
use app\models\MachineHasStorageDevice;
use app\models\VerifyCompatibilitySearch;
use app\services\MachineServices;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;

class VerifyCompatibilityController extends BaseController
{
    /** @var MachineServices */
    private $machineServices;

    public function init()
    {
        parent::init();
        $this->machineServices = new MachineServices();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        $behaviors['verbFilter'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => [ 'POST' ],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $bodyParams = $request->getBodyParams();
        //
        $model = new VerifyCompatibilitySearch();
        $model->load($bodyParams, '');
        if(isset($bodyParams['storageDevices']))
        {
            $model->storageDevices = [];
            foreach($bodyParams['storageDevices'] as $storageDevice)
            {
                $machineHasStorageDevice = new MachineHasStorageDevice();
                $machineHasStorageDevice->load($storageDevice, '');
                $model->storageDevices[] = $machineHasStorageDevice;
            }
        }
        if($model->validate())
        {
            $validationResults = $this->machineServices->validateCompabilitity(
                $model->motherboardId,
                $model->processorId,
                $model->ramMemoryId,
                $model->ramMemoryAmount,
                $model->graphicCardId,
                $model->graphicCardAmount,
                $model->powerSupplyId,
                $model->storageDevices
            );
            if(sizeof($validationResults) == 0)
            {
                return [
                    'message' => 'Machine is valid',
                    'valid' => true
                ];
            }
            else
            {
                $response->statusCode = 400;
                return $validationResults;
            }
        }
        else
        {
            $response->statusCode = 400;
            return $model->errors;
        }
    }
}
