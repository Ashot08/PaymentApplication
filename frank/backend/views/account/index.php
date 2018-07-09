<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все счета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute'=>'account_number_id',
                'label'=>'Имя пользователя',
                'vAlign'=>'middle',
                'width'=>'140px',
                'value'=>function ($model, $key, $index, $widget) {
                    return Html::a($model->user->username, '#', []);
                },
                'format'=>'raw'
            ],

            [
                'attribute'=> 'user',
                'label'=>'E-mail',
                'vAlign'=>'middle',
                'width'=>'140px',
                'value' => 'user.email',
                'format'=>'raw'
            ],
            'user_id',
            'account_number_id',
            'account_name',
            'opening_date',
            [
                'attribute'=>'Balance',
                'label'=>'Баланс',
                'vAlign'=>'middle',
                'width'=>'190px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $balance = findBalance(
                    \common\models\Transaction::find()->where(['recipient' => [$model->account_number_id]])->all(),
                    \common\models\Transaction::find()->where(['account_number' => [$model->account_number_id]])->all());
                },
            ],
        ];
?>
    <?php

        $fullExportMenu = ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'target' => ExportMenu::TARGET_BLANK,
            'fontAwesome' => true,
            'pjaxContainerId' => 'kv-pjax-container',
            'dropdownOptions' => [
                'label' => 'Full',
                'class' => 'btn btn-default',
                'itemsBefore' => [
                    '<li class="dropdown-header">Export All Data</li>',
                ],
            ],
        ]);
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'filterModel' => $searchModel,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Счета</h3>',
            ],
            // set a label for default menu
            'export' => [
                'label' => 'Экспорт',
                'fontAwesome' => true,
            ],
            // toolbar can include the additional full export menu
            'toolbar' => [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-warning-sign"> </i>  Нарушители', ['outlaw/index'], [
                        'data-pjax'=>0,
                        'class' => 'btn btn-default',
                        'title'=>Yii::t('kvgrid', 'Список нарушителей')
                    ])
                ],

                ['content'=>
                    Html::a('Импорт операций', ['admin/import'], [
                        'data-pjax'=>0,
                        'class' => 'btn btn-default',
                        'title'=>Yii::t('kvgrid', 'Импорт')
                    ])
                ],

                '{export}',
                $fullExportMenu,
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                        'data-pjax'=>0,
                        'class'=>'btn btn-success',
                        'title'=>Yii::t('kvgrid', 'Add Account')
                    ]). ' '.

                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'data-pjax'=>0,
                        'class' => 'btn btn-default',
                        'title'=>Yii::t('kvgrid', 'Reset Grid')
                    ])
                ],
            ]
        ]);
    ?>
    <?php Pjax::end(); ?>
</div>
<!--<p>-->
<!--    --><?//= Html::a('Создать счет', ['create'], ['class' => 'btn btn-primary']) ?>
<!--</p>-->