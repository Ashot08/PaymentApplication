<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

$this->title = 'Создать операцию';
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?//= $this->render('_form', [
//        'model' => $model,
//    ]) ?>
    <?php $form = ActiveForm::begin(['id' => 'form-create-account']); ?>
    <?= $form->field($model, 'transaction_value')->textInput(['autofocus' => true, 'placeholder'=>'Сумма перевода',]) ?>

    <?= $form->field($model, 'account_number')->textInput(['placeholder'=>'Номер счета отправителя',])?>

    <?= $form->field($model, 'recipient')->textInput(['placeholder'=>'Номер счета получателя',])?>

    <?= $form->field($model, 'comment')->textInput(['placeholder'=>'Комментарий',])?>


    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'create-account-button']) ?>
    </div>

</div>
<?php ActiveForm::end(); ?>

