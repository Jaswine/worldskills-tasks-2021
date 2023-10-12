<?php

use app\models\UploadFileForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if(!isset($model))
{
    $model = new UploadFileForm();
}

$form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
    'action' => '/upload/upload-file'
]);
?>
<?= $form->field($model, 'uploadFile')->fileInput([
    'accept' => '.jpg,.png'
]) ?>
<?= Html::submitButton('Send File')
?>
<?php
ActiveForm::end();
?>
