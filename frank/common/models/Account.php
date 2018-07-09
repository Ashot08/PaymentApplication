<?php

namespace common\models;

use Yii;
use yii\base\Security;

/**
 * This is the model class for table "account".
 *
 * @property int $account_number_id
 * @property string $account_name
 * @property string $opening_date
 * @property User $user
 * @property int $user_id
 * @property Transaction[] $transactions
 * @property Account $account
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_name', 'user_id'], 'trim'],
            [['account_name', ], 'required'],
            [['opening_date'], 'safe'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['account_name'], 'string', 'max' => 48],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_number_id' => 'Номер счета',
            'account_name' => 'Имя счета',
            'opening_date' => 'Дата открытия',
            'user_id' => 'ID пользователя',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function setOpeningDate()
    {
        $date = new \DateTime('NOW');
        return $date->format('c');
    }

    public function setAccountNumber()
    {
        $rand = rand(100000000,999999999);
        while (Account::findOne($rand)){
            $rand = rand(100000000,999999999);
        }
        return $rand;
    }

    public function createAccount()
    {
        $this->account_number_id = $this->setAccountNumber();
        $this->opening_date = $this->setOpeningDate();
        $this->setOpeningDate();
        $this->user_id = Yii::$app->getUser()->getId();
        $this->save();
    }

    public function searchAccount()
    {
        return $this->find()->where('user_id' === Yii::$app->getUser()->getId())->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['account_number' => 'account_number_id']);
    }

}
