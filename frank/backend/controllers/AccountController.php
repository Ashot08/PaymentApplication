<?php

namespace backend\controllers;

use backend\models\Outlaw;
use Yii;
use common\models\Account;
use common\models\Transaction;
use common\models\TransactionSearch;
use common\models\AccountSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('admin permission')){
            $outlaw = new Outlaw();
            if(!Outlaw::findOne(Yii::$app->getUser()->getId())){
                $outlaw->user_id = Yii::$app->getUser()->getId();
                $outlaw->save();
            }
            return $this->goHome();
        }
        else{

            $searchModel = new AccountSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $searchModelTransaction = new TransactionSearch();
            $dataProviderTransaction = $searchModelTransaction->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProviderTransaction' => $dataProviderTransaction,
            ]);
        }
    }
    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!\Yii::$app->user->can('admin permission')){

            $outlaw = new Outlaw();
            if(!Outlaw::findOne(Yii::$app->getUser()->getId())){
                $outlaw->user_id = Yii::$app->getUser()->getId();
                $outlaw->save();
            }

            return $this->goHome();
        }
        else{
            $searchModel = new AccountSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('view', [
                'model' => $this->findModel($id),
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('admin permission')){

            $outlaw = new Outlaw();
            if(!Outlaw::findOne(Yii::$app->getUser()->getId())){
                $outlaw->user_id = Yii::$app->getUser()->getId();
                $outlaw->save();
            }

            return $this->goHome();
        }
        else{
            $model = new Account();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->account_number_id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('admin permission')){
            return $this->goHome();
        }
        else{
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->account_number_id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
