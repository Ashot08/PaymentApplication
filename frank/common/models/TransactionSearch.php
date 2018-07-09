<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form of `common\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    public $accountNumber;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_number', 'account_number', 'recipient', 'transaction_value'], 'integer'],
            [['date', 'accountNumber', 'comment'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transaction::find();
        $query->joinWith(['accountNumber.user']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        $dataProvider->sort->attributes['accountNumber.user'] = [
            'asc' => ['accountNumber.user.email'=> SORT_ASC],
            'desc' => ['accountNumber.user.email'=> SORT_DESC],
        ];

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'transaction_number' => $this->transaction_number,
            'account_number' => $this->account_number,
            'recipient' => $this->recipient,
            'transaction_value' => $this->transaction_value,
            'date' => $this->date,
            'comment' => $this->comment,
        ])
            ->andFilterWhere(['like', 'accountNumber.user', $this->accountNumber]);

        return $dataProvider;
    }
}
