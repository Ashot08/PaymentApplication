<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\Url;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'История транзакций';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="transaction-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?php
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

            'transaction_number',
            'account_number',
            'recipient',
            'transaction_value',
            'date',

            [
                'attribute'=>'User',
                'label'=>'Имя пользователя',
                'vAlign'=>'middle',
                'width'=>'140px',
                'value'=>'accountNumber.user.username',
                'format'=>'raw'
            ],

            [
                'attribute'=>'User',
                'label'=>'E-mail отправителя',
                'vAlign'=>'middle',
                'width'=>'190px',
                'value'=>'accountNumber.user.email',
                'format'=>'raw'
            ],
            'comment'
        ];

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
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-briefcase"></i> Операции</h3>',
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
                        'title'=>Yii::t('kvgrid', 'Add Transaction')
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


