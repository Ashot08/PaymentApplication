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

class TransactionController extends Controller
{
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest){
            $model = new Transaction();
            $recipient = Account::find()->where(['account_number_id' => [$_POST['Transaction']['recipient']?? null]])->one();
            $accountNumber = Account::find()->where(['user_id' => [Yii::$app->getUser()->getId()]])->all();

            $profit = Transaction::find()->where(['recipient' => [$_POST['checkedAccount'] ?? null]])->all();
            $decrease = Transaction::find()->where(['account_number' => [$_POST['checkedAccount'] ?? null]])->all();
            $balance = findBalance($profit, $decrease);

            if ($model->load(\Yii::$app->request->post()) &&
                $model->validate() &&
                !empty($_POST['checkedAccount']) &&
                $recipient &&
                $balance >= $_POST['Transaction']['transaction_value']) {
                    $model->setTransactionAccountNumber($_POST['checkedAccount']);
                    $result = $model->createTransaction();
                    $this->refresh();
                    Yii::$app->session->setFlash('success', 'Перевод выполнен успешно');
                    return goPage(Url::to(['transaction/index']));
            }
            elseif(!empty($_POST) && empty($_POST['checkedAccount'])){
                Yii::$app->session->setFlash('error', 'Выберите счет с которого необходимо перевести средства');
                return goPage(Url::to(['transaction/index']));
            }
            elseif(!empty($_POST)){
                Yii::$app->session->setFlash('error', 'Введите корректную сумму перевода');
                return goPage(Url::to(['transaction/index']));
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