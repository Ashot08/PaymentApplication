<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

$this->title = $model->transaction_number;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $gridColumns = [
        [
            'attribute' => 'userEmail','label' => 'ID пользователя', 'value' => function($model) {
            return $model->accountNumber->user->id;
        }],

        'transaction_number',
        'account_number',
        'recipient',
        'transaction_value',
        'date',

    ];?>
    <div class ="col-md-12 text-right">
        <h4>Импорт операций</h4>
        <?php
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
            ]);
        ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'userEmail','label' => 'ID пользователя', 'value' => function($model) {
                return $model->accountNumber->user->id;
            }],
            'transaction_number',
            'account_number',
            'recipient',
            'transaction_value',
            'date',
        ],
    ]) ?>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->transaction_number], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->transaction_number], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
