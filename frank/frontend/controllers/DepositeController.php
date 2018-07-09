<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 02.07.2018
 * Time: 22:54
 */

namespace frontend\controllers;
use common\models\Transaction;
use yii\web\Controller;
use Yii;
use common\models\LoginForm;
use common\models\Account;
use yii\helpers\Url;

class DepositeController extends Controller
{
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest){
            $model = new Transaction();
            $recipient = Account::find()->where(['account_number_id' => [$_POST['Transaction']['account_number']?? null]])->one();
            $accountNumber = Account::find()->where(['user_id' => [Yii::$app->getUser()->getId()]])->all();

            if ($model->load(\Yii::$app->request->post()) &&
                !empty($_POST['checkedAccount'])
                ) {
                $model->deposite($_POST['checkedAccount']);
                $this->refresh();
                Yii::$app->session->setFlash('success', 'Счет пополнен');
                return goPage(Url::to(['deposite/index']));

            }
            elseif(!empty($_POST) && empty($_POST['checkedAccount'])){
                Yii::$app->session->setFlash('error', 'Выберите счет, который хотите пополнить');
            }

            return $this->render('index', [
                'model' => $model, 'accountNumber' => $accountNumber, 'recipient' => $recipient,
            ]);
        }
        else{
            Yii::$app->session->setFlash('success', 'Войдите в систему или зарегистрируйтесь');
            return $this->goHome();
        }

    }
}