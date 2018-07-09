<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 08.07.2018
 * Time: 16:49
 */
use yii\widgets\ActiveForm;
//echo 'ADMIN';
//foreach ($data as $one){
//    debug($one);
////    debug($one['Имя пользователя']) . '/';
//}
//?>
<div class="col-md-12 panel panel-default commonBlock">

    <div class="col-md-12 panel panel-default">
        <div class="col-md-12 panel panel-heading">
            <h4 class="">Требуемые поля для импортируемого XLS файла:</h4>
        </div>

        <div class="col-md-6 commonBlock">
            <ul>
                <li>Номер операции</li>
                <li>Имя пользователя</li>
                <li>Номер счета отправителя</li>
                <li>Получатель</li>
                <li>Сумма</li>
                <li>Дата</li>
                <li>E-mail отправителя</li>
            </ul>
        </div>
    </div>

    <div class="col-md-12 commonBlock">
        Для корректной загрузки файлов рекомендуется использовать образец XLS файла, скачать который можно по ссылке ниже.
    </div>
    <div class="col-md-12 commonBlock">
        <div class="col-md-6">
            <a href="/backend/web/uploads/grid.xls">
                <h4>Скачать шаблон XLS</h4>
            </a>
        </div>
    </div>
</div>

<div class="col-md-12 panel panel-default commonBlock">

    <div class="col-md-6 panel panel-heading">
        <h4 class="">Выполнить импорт операций</h4>
    </div>

    <div class="col-md-6 commonBlock">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= $form->field($model, 'xlsFile')->fileInput() ?>
        <button>Отправить</button>
        <?php ActiveForm::end() ?>
    </div>

</div>

