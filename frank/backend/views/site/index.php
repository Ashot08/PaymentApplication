<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <ul>
            <li class="panel panel-heading"><a href="<?php echo Url::to(['account/index'])?>">Счета</a></li>
            <li class="panel panel-heading"><a href="<?php echo Url::to(['transaction/index'])?>">Транзакции</a></li>
        </ul>
    </div>

</div>
