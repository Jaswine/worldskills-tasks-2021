<?php

namespace app\controllers\alatech\api;

use app\base\BaseController;
use app\services\MachineServices;
use yii\filters\VerbFilter;
use yii\web\Response;

class ImagesController extends BaseController
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
        $behaviors['verbFilter'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['GET']
            ]
        ];
        return $behaviors;
    }

    public function actionIndex($id)
    {
        $imageBinary = $this->machineServices->getImageFromId($id);
        if($imageBinary !== false)
        {
            $imageFilePath = $this->machineServices->getImagePathFromId($id);
            $fileInfoResource = finfo_open();
            $fileMimeType = finfo_file($fileInfoResource, $imageFilePath, FILEINFO_MIME);
            \Yii::$app->response->headers->set('Content-Type', $fileMimeType);
            // This line is fundamental to avoid Yii treating image as JSON
            \Yii::$app->response->format = Response::FORMAT_RAW;
            \Yii::$app->response->data = $imageBinary;
            return \Yii::$app->response;
        }
        else
        {
            \Yii::$app->response->statusCode = 404;
            return
                [
                    'message' => 'Image not found'
                ];
        }
    }
}
