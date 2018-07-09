<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Outlaw */

$this->title = $model->owtlaw_id;
$this->params['breadcrumbs'][] = ['label' => 'Outlaws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlaw-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->owtlaw_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->owtlaw_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'owtlaw_id',
            'user_id',
        ],
    ]) ?>

</div>
