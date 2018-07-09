<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Outlaw */

$this->title = 'Create Outlaw';
$this->params['breadcrumbs'][] = ['label' => 'Outlaws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlaw-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
