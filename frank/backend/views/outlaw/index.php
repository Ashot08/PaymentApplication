<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OutlawSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Нарушители';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlaw-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'owtlaw_id',
            'user_id',
            [
                'attribute' => 'user',
                'value' => 'user.username'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Занести в список нарушителей', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::end(); ?>
</div>
