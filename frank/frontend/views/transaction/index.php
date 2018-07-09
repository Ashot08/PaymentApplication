<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 02.07.2018
 * Time: 22:57
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<div class = "col-md-12">
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['transaction/index'])?>">Переводы</a></div>
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['deposite/index'])?>">Пополнить счет</a></div>
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['transaction-history/index'])?>">История транзакций</a></div>
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['site/about'])?>">Справочная информация</a></div>
</div>
    <?php $form = ActiveForm::begin(['id' => 'form-create-account']); ?>
<div class="col-md-12 panel panel-default">

    <h2 class="panel panel-heading">Перевод денежных средств</h2>
    <div class="col-md-6">

        <h3>Мои счета</h3>

        <div class="col-md-12 panel panel-heading">
            <div class="col-xs-3">Имя счета</div>
            <div class="col-xs-3">Номер счета</div>
            <div class="col-xs-3">Баланс</div>
            <div class="col-xs-3">Выбрать</div>
        </div>

        <?php foreach($accountNumber as $number){ ?>
            <?php
                $profit = \common\models\Transaction::find()->where(['recipient' => [$number['account_number_id']]])->all();
                $decrease = \common\models\Transaction::find()->where(['account_number' => [$number['account_number_id']]])->all();
                $balance = findBalance($profit, $decrease);
            ?>
            <div class="col-md-12">
                <div class="col-xs-3">
                    <strong><?php echo $number->account_name;?></strong>
                </div>
                <div class="col-xs-3">
                    <?php echo $number->account_number_id;?>
                </div>
                <div class="col-xs-3">
                    <?php echo $balance;?>
                </div>
                <div class="col-md-3">
                    <input type ="radio" name="checkedAccount" value="<?php echo $number->account_number_id;?>">
                </div>
            </div>
            <?php
                }
        ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'transaction_value')->textInput(['autofocus' => true, 'placeholder'=>'Сумма перевода',]) ?>
<!--            --><?//= $form->field($model, 'recipient')->textInput(['placeholder'=>'Номер счета получателя',])?>

            <?= $form->field($model, 'recipient')->dropDownList(
                ArrayHelper::map(
                    \common\models\Account::find()->where(['user_id' => [1]])->all(),
                    'account_number_id',
                    'account_name')
            );?>
        <?= $form->field($model, 'comment')->textarea(['autofocus' => true, 'placeholder'=>'Комментарий',]) ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'create-account-button']) ?>
            </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>