<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model common\models\Account */

$this->title = $model->account_number_id;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'userEmail','label' => 'Имя пользователя', 'value' => function($model) {
                return $model->user->username;
            }],

            [
                'attribute' => 'userEmail','label' => 'E-mail', 'value' => function($model) {
                return $model->user->email;
            }],

            'user_id',
            'account_number_id',
            'account_name',
            'opening_date',

            [
                'attribute' => 'balance', 'label' => 'Баланс', 'value' => function($model) {
                $balance = findBalance(
                    \common\models\Transaction::find()->where(['recipient' => [$model->account_number_id]])->all(),
                    \common\models\Transaction::find()->where(['account_number' => [$model->account_number_id]])->all());

                return $balance;
            }],
        ],
    ]) ?>
</div>

<p>
    <?= Html::a('Update', ['update', 'id' => $model->account_number_id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->account_number_id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
    <?php
        $gridColumns = [
            [
                'attribute' => 'userEmail','label' => 'Имя пользователя', 'value' => function($model) {
                return $model->user->username;
            }],

            [
                'attribute' => 'userEmail','label' => 'E-mail', 'value' => function($model) {
                return $model->user->email;
            }],

            'user_id',
            'account_number_id',
            'account_name',
            'opening_date',

            [
                'attribute' => 'balance', 'label' => 'Баланс', 'value' => function($model) {
                $balance = findBalance(
                    \common\models\Transaction::find()->where(['recipient' => [$model->account_number_id]])->all(),
                    \common\models\Transaction::find()->where(['account_number' => [$model->account_number_id]])->all());

                return $balance;
            }],

        ];
        ?>
        <div class="col-md-12 text-right">
            <h4>Импорт операций</h4>
            <?php
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
            ]);
            ?>
        </div>
</p>