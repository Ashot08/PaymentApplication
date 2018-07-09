<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Payment Application';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class = "col-md-8"><strong>Payment Application</strong> - это маленькая платежная системка.
        Вы можете зарегистрироваться как пользователь.
        Пользователь может открыть счет, пополнять его, переводить и принимать средства.
        В приложении не активна функция переводов средств между пользователями (в соответствии с ТЗ),
        но ее можно активировать, если потребуется.
    </div>
</div>
