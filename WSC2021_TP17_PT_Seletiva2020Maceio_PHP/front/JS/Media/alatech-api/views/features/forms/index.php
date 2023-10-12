<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model \app\models\features\forms\Login */

$form = ActiveForm::begin([
    'id' => 'login-form',
]);
$user = User::findOne(['id' => 1]);
?>
<h1>
    Forms Controller
</h1>
<?= $form->field($model, 'username')->textInput(['placeholder' => $user->username])->hint('Input your username') ?>
<?= $form->field($model, 'password')->passwordInput(['placeholder' => $user->password]) ?>
<?= $form->errorSummary($model) ?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Login', [ 'class' => 'btn btn-primary' ]) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
