<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Outlaw */

$this->title = 'Update Outlaw: ' . $model->owtlaw_id;
$this->params['breadcrumbs'][] = ['label' => 'Outlaws', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->owtlaw_id, 'url' => ['view', 'id' => $model->owtlaw_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outlaw-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
