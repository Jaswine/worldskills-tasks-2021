<?php

use app\assets\CountryWidget;
use app\assets\HelloWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<html>

<div class="country-index">
    <p>
        <?= Url::to(['/country']) ?>
    </p>

    <?php $this->beginBlock('title') ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php $this->endBlock() ?>

    <?php $helloWidget = HelloWidget::begin(['name' => 'Lucas Viana']); ?>
        <h1>IAE PARSA</h1>
    <?php HelloWidget::end(); ?>

    <?= $this->blocks['title'] ?>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php foreach($dataProvider->query->all() as $country): ?>
        <?= CountryWidget::widget(['country' => $country->attributes]) ?>
    <?php endforeach; ?>
</div>
