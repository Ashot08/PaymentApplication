<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 03.07.2018
 * Time: 22:15
 */

namespace backend\controllers;
use common\models\Account;
use common\models\Transaction;
use common\models\User;
use yii\web\Controller;
use Yii;
use backend\models\Outlaw;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;


class AdminController extends Controller
{
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('admin permission')) {

            $outlaw = new Outlaw();
            if(!Outlaw::findOne(Yii::$app->getUser()->getId())){
                $outlaw->user_id = Yii::$app->getUser()->getId();
                $outlaw->save();
            }

            return $this->goHome();
        }
        else{
            return $this->render('index');
        }
    }

    public function actionImport()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->xlsFile = UploadedFile::getInstance($model, 'xlsFile');
            if ($model->upload()) {
                $name = $model->xlsFile->name;

                $data = \moonland\phpexcel\Excel::import('uploads/' . $name, [
                    'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
                    'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
                    'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                ]);

                foreach ($data as $one){
                    $transaction = new Transaction();

                    $checkUnique = Transaction::find()->where([
                        'account_number' => $one['Номер счета отправителя'],
                        'recipient' => $one['Получатель'],
                        'transaction_value' => $one['Сумма'],
                        'date' => $one['Дата'],
                    ])->one();

                    if(!$checkUnique){

                        $checkAccountNumber = Account::find()->where(['account_number_id' => $one['Номер счета отправителя']])->one();
                        $user = User::find()->where(['email' => $one['E-mail отправителя']])->one();
                        if(!$user){
                            $user = new User();
                            $user->email = $one['E-mail отправителя'];
                            $user->username = $one['Имя пользователя'];
                            $user->password_hash = '$2y$13$M9sbj3Gva0FUTeScRa4TxedjRohFkvlwfZkMGNXjUvRveBCKsIHZG';
                            $user->save();
                        }
                        if(!$checkAccountNumber){
                            $account = new Account();
                            $account->account_number_id = $one['Номер счета отправителя'];
                            $account->account_name = 'unnamed';
                            $account->opening_date = $account->setOpeningDate();
                            $account->user_id = $user['id'];
                            $account->save();
                        }

                        $transaction->account_number = $one['Номер счета отправителя'];
                        $transaction->recipient = $one['Получатель'];
                        $transaction->transaction_value = $one['Сумма'];
                        $transaction->date = $one['Дата'];
                        $transaction->comment = $one['Комментарий'];
                        $transaction->save();
                    }
                }
//                $this->refresh();
//                return $this->render('import', ['data' => $data, 'model' => $model,]);
                Yii::$app->session->setFlash('success', 'Импорт выполнен успешно');
                return goPage(Url::to(['admin/import']));
            }
        }
        return $this->render('import', ['model' => $model]);
    }
}
