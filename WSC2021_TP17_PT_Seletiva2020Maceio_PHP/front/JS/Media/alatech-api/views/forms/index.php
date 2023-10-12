<?php

use app\models\Country;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var string[] $countryNames */
?>
<style>
    div.required label.control-label:after {
        content: " *";
        color: red;
    }
</style>
<?php
// Pjax::begin();
$form = ActiveForm::begin([
    'id' => 'form-play',
    'options' => ['class' => 'form-horizontal']
]);
?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'age')->input('number', [ 'min' => 0, 'max' => 100 ]) ?>
    <?= $form->field($model, 'private')->checkbox() ?>
    <?= $form->field($model, 'color')->input('color') ?>
    <?= $form->field($model, 'picture')->fileInput([ 'accept' => '.jpg,.png,.jpeg' ]) ?>
    <?= $form->field($model, 'nicknames')->checkboxList($countryNames) ?>
    <?php //echo $form->field($model, 'nicknames')->dropDownList($countryNames, ['prompt' => 'Select a country']) ?>
    <?= $form->errorSummary($model) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php
    ActiveForm::end();
    // Pjax::end();
?>