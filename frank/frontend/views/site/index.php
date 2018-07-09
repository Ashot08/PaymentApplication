<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'My Payment Application';
?>

<h1>Управление счетами</h1>

<div class="site-index">

    <div class = "col-md-12 headerHome">
        <div class="col-md-3"><a href="<?php echo Url::to(['transaction/index'])?>">Переводы</a></div>
        <div class="col-md-3"><a href="<?php echo Url::to(['deposite/index'])?>">Пополнить счет</a></div>
        <div class="col-md-3"><a href="<?php echo Url::to(['transaction-history/index'])?>">История транзакций</a></div>
        <div class="col-md-3"><a href="<?php echo Url::to(['site/about'])?>">Справочная информация</a></div>
    </div>

    <div class="col-md-6 panel panel-default backBackground">
        <h2 class="panel panel-heading">Открыть счет</h2>
        <?php $form = ActiveForm::begin(['id' => 'form-create-account']); ?>
        <?= $form->field($model, 'account_name')->textInput(['autofocus' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton('Открыть счет', ['class' => 'btn btn-primary', 'name' => 'create-account-button']) ?>
        </div>
        <p class="panel-footer">
            Лимит на количество счетов: 1
        </p>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-12 col-xs-12 panel panel-default backBackground">
        <h3>Мои счета</h3>
        <div class="col-md-12 col-xs-4 panel panel-heading">
            <div class="col-md-4">Имя счета</div>
            <div class="col-md-4">Номер счета</div>
            <div class="col-md-4">Баланс</div>
        </div>

        <?php
        foreach ($accountNumber as $account){?>
            <?php
            $profit = \common\models\Transaction::find()->where(['recipient' => [$account['account_number_id']]])->all();
            $decrease = \common\models\Transaction::find()->where(['account_number' => [$account['account_number_id']]])->all();
            $balance = findBalance($profit, $decrease);
            ?>
            <div class="col-md-12 col-xs-4 marginBottom">
                <div class = "col-md-4"><?php echo $account->account_name; ?></div>

                <div class = "col-md-4"><?php echo $account->account_number_id;?></div>

                <div class = "col-md-4"><strong><?php echo $balance;?></strong></div>
            </div>
        <?php }?>

    </div>
<?php
    ?>
</div>
