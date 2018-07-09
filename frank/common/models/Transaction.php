<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $transaction_number Primary key
 * @property int $account_number
 * @property int $recipient
 * @property int $transaction_value
 * @property string $date
 * @property string $comment
 * @property Account $accountNumber
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_number', 'recipient', 'transaction_value'], 'default', 'value' => null],
            [['account_number', 'recipient', 'transaction_value'], 'integer'],
            [['transaction_value', 'recipient'], 'required'],
            [['date', 'comment'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transaction_number' => 'Номер операции',
            'account_number' => 'Номер счета отправителя',
            'recipient' => 'Получатель',
            'transaction_value' => 'Сумма',
            'date' => 'Дата',
            'comment' => 'Комментарий'
        ];
    }

    public function setTransactionDate()
    {
        $date = new \DateTime('NOW');
        return $date->format('c');
    }

    public function createTransaction()
    {
        $this->date = $this->setTransactionDate();
        $this->save();
    }


    public function deposite($recipient)
    {
        $this->account_number = 0;
        $this->recipient = $recipient;
        $this->date = $this->setTransactionDate();
        $this->save();
    }

    public function setTransactionAccountNumber($accountNumber)
    {
        $this->account_number = $accountNumber;
    }

    public function searchRecipient()
    {
        return $this->find()->where('recipient' === $this->recipient)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountNumber()
    {
        return $this->hasOne(Account::className(), ['account_number_id' => 'account_number']);
    }
}
