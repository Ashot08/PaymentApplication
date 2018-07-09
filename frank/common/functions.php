<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 03.07.2018
 * Time: 11:15
 */
function debug($arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function findQuantity($query)
{
    $summ = 0;
    foreach ($query as $array){
        $value = $array['transaction_value'] . '<br>';
        $summ = (int)$value + $summ;
    }
    return $summ;
}
function findBalance($profit, $decrease)
{
    $profit = findQuantity($profit);
    $decrease = findQuantity($decrease);
    $balance = $profit - $decrease;
    return $balance;
}

function goPage($url)
{
    return Yii::$app->getResponse()->redirect($url);
}