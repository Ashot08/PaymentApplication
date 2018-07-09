<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Account */

$this->title = 'Зарегистрировать счет';
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<dib>
    Для создания корпоративного счета используйте установите значение <em>ID пользователя</em> - 1.
</dib>
