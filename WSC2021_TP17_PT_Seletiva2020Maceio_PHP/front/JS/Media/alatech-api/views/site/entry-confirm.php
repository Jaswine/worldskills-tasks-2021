<?php

use app\models\EntryForm;
use yii\helpers\Html;

/** @var EntryForm $model */
$model;
?>
<p>You have entered the following information:</p>

<ul>
    <li>
        <label for="name">Name</label>
        <?= Html::encode($model->name) ?>
    </li>
    <li>
        <label for="email">E-mail</label>
        <?= Html::encode($model->email) ?>
    </li>
</ul>
