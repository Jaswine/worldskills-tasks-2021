<?php

namespace app\controllers\alatech\api;

use app\base\BaseActiveController;
use app\models\Machine;
use app\models\MachineHasStorageDevice;
use app\services\MachineServices;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

class MachinesController extends BaseActiveController
{
    /** @var MachineServices */
    private $machineServices;
    public $modelClass = Machine::class;

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
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        $allowedActions = [];
        $allowedActions['options'] = $actions['options'];
        return $allowedActions;
    }

    public function actionIndex()
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $dataProvider = new ActiveDataProvider();
        $dataProvider->query = Machine::find();
        $dataProvider->pagination = new Pagination([
            'params' => [
                'page' => intval($queryParams['page'] ?? 1),
                'per-page' => intval($queryParams['pageSize'] ?? 10)
            ],
            'validatePage' => false
        ]);
        return $dataProvider;
    }

    public function actionView($id)
    {
        $model = Machine::find()
            ->where(['id' => $id])
            ->with('storageDevices')
            ->one();
        return $model->toArray([], ['storageDevices']);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        /* @var Machine $model */
        $model = new Machine();
        $bodyParams = $request->getBodyParams();
        /** @var MachineHasStorageDevice[] $storageDevices */
        $storageDevices = [];
        if(isset($bodyParams['storageDevices'])) {
            $storageDevices = array_map(
                function($item)
                {
                    $model = new MachineHasStorageDevice();
                    $model->load($item, '');
                    return $model;
                },
                $bodyParams['storageDevices']
                );
        }
        $model->load($bodyParams, '');
        if(isset($bodyParams['imageBase64']))
        {
            // Upload new image with the ID
            $imageUrl = $this->machineServices->uploadMachineImageFromBase64($model, $bodyParams['imageBase64']);
            $model->imageUrl = $imageUrl;
        }
        else
        {
            $model->addError('imageBase64', 'No image supplied');
        }
        $validationResult = $this->machineServices->validateWholeMachine($model, $storageDevices);
        if($model->validate([], false) && sizeof($validationResult) == 0)
        {
            if ($model->save()) {
                // Add the new storage devices
                foreach($storageDevices as $storageDevice)
                {
                    $storageDevice->machineId = $model->id;
                    $storageDevice->save();
                }
                $response->setStatusCode(201);
                $id = implode(',', array_values($model->getPrimaryKey(true)));
                $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
                return $model;
            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            }
        }
        else
        {
            // Delete newly uploaded image
            $this->machineServices->deleteMachineImage($model);
        }
        return $model->errors;
    }

    public function actionUpdate($id) {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        /* @var Machine $model */
        $model = Machine::findOne(['id' => $id]);
        $oldStorageDevices = MachineHasStorageDevice::findAll(['machineId' => $id]);
        $bodyParams = $request->getBodyParams();
        /** @var MachineHasStorageDevice[] $storageDevices */
        $storageDevices = [];
        if(isset($bodyParams['storageDevices'])) {
            $storageDevices = array_map(
                function($item) use ($id)
                {
                    $model = new MachineHasStorageDevice();
                    $model->load($item, '');
                    $model->machineId = $id;
                    return $model;
                },
                $bodyParams['storageDevices']
                );
        }
        $model->load($bodyParams, '');
        // Upload new image with the ID
        if(isset($bodyParams['imageBase64']))
        {
            $imageUrl = $this->machineServices->uploadMachineImageFromBase64($model, $bodyParams['imageBase64']);
            $model->imageUrl = $imageUrl;
        }
        $validationResult = $this->machineServices->validateWholeMachine($model, $storageDevices);
        if($model->validate([], false) && sizeof($validationResult) == 0)
        {
            if ($model->save()) {
                // Delete all storage devices
                foreach($oldStorageDevices as $oldStorageDevice)
                {
                    $oldStorageDevice->delete();
                }
                // Add the new storage devices
                foreach($storageDevices as $storageDevice)
                {
                    $storageDevice->save();
                }
                $response->setStatusCode(200);
                $id = implode(',', array_values($model->getPrimaryKey(true)));
                $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
                return $model;
            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            }
        }
        else
        {
            // Delete newly uploaded image
            if(isset($bodyParams['imageBase64']))
            {
                $this->machineServices->deleteMachineImage($model);
            }
        }
        return $model->errors;
    }

    public function actionDelete($id)
    {
        $model = Machine::find()
            ->where(['id' => $id])
            ->with('machineHasStorageDevices')
            ->one();
        if($model != null)
        {
            // Delete image
            $this->machineServices->deleteMachineImage($model);
            // Delete machineHasStorageDevice
            foreach($model->getMachineHasStorageDevices()->all() as $machineHasStorageDevice)
            {
                $machineHasStorageDevice->delete();
            }
            // Delete machine
            $model->delete();
            Yii::$app->response->statusCode = 204;
        }
        else
        {
            Yii::$app->response->statusCode = 404;
            return [
                'message' => 'Machine not found'
            ];
        }
        return Yii::$app->response;
    }
}
