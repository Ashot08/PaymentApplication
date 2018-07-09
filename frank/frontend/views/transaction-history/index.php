<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 03.07.2018
 * Time: 14:20
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class = "col-md-12">
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['transaction/index'])?>">Переводы</a></div>
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['deposite/index'])?>">Пополнить счет</a></div>
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['transaction-history/index'])?>">История транзакций</a></div>
    <div class="panel panel-heading col-md-3"><a href="<?php echo Url::to(['site/about'])?>">Справочная информация</a></div>
</div>
<h2 class="panel panel-heading">Исходящие платежи</h2>

    <div class="col-md-12 panel panel-default">
        <div class="col-xs-12 panel panel-primary">
            <div class="col-xs-4">Номер счета</div>
            <div class="col-xs-4">Сумма</div>
            <div class="col-xs-4">Дата и время</div>
        </div>
<!--        --><?php
            foreach($accountNumber as $number){
                foreach (\common\models\Transaction::find()->where(['account_number' => [$number['account_number_id']]])->all() as $name){
                    $comment = ' (адресат: ' . $name['recipient'] . ')';
                    if($name['recipient'] < 100){
                        $comment = ' (адресат: ' . \common\models\Account::find()->where(['account_number_id' => $name['recipient']])->one()->account_name. ')';
                    }
        ?>


                <div class="marginBottom col-xs-12">
                <div class="col-xs-4"><strong><?php echo $name['account_number']?></strong><?php echo $comment;?></div>
                <div class="col-xs-4"><?php echo $name['transaction_value']?></div>
                <div class="col-xs-4"><?php echo $name['date']?></div>
            </div>
            <?php
            }
        }
            ?>
    </div>

<h2 class="panel panel-heading">Входящие платежи</h2>

    <div class="col-md-12 panel panel-default">
        <div class="col-xs-12 panel panel-primary">
            <div class="col-xs-4">Номер счета</div>
            <div class="col-xs-4">Сумма перевода</div>
            <div class="col-xs-4">Дата и время</div>
        </div>
        <?php
        foreach($accountNumber as $number){
            foreach (\common\models\Transaction::find()->where(['recipient' => [$number['account_number_id']]])->all() as $name){
            $comment = '';
            if($name['account_number'] === 0){
                $comment = ' (пополнение счета)';
            }
            else{
                $comment = ' (от ' . $name['account_number'] . ')';
            }
            ?>
            <div class="marginBottom col-xs-12">
                <div class="col-xs-4"><strong> <?php echo $name['recipient'] ?> </strong> <?php echo $comment ?></div>
                <div class="col-xs-4"><?php echo $name['transaction_value'] ?></div>
                <div class="col-xs-4"><?php echo $name['date']?></div>
            </div>
            <?php
            }
        }
        ?>
    </div>