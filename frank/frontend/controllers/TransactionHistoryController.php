<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 03.07.2018
 * Time: 14:10
 */

namespace frontend\controllers;

use common\models\Account;
use common\models\Transaction;
use yii\web\Controller;
use Yii;

class TransactionHistoryController extends Controller
{
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest){
            $user = Yii::$app->getUser()->getId();
            $model = new Transaction();
            $accountNumber = Account::find()->where(['user_id' => [$user]])->all();
        }
        return $this->render('index', [
            'accountNumber' => $accountNumber,
        ]);
    }
}