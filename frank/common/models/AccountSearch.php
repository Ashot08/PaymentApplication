<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Account;

/**
 * AccountSearch represents the model behind the search form of `common\models\Account`.
 */
class AccountSearch extends Account
{
    public $user;
    public $transactions;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_number_id', 'user_id'], 'integer'],
            [['account_name', 'opening_date', 'user', 'transactions', ], 'safe'],
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
        $query = Account::find();
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.email'=> SORT_ASC],
            'desc' => ['user.email'=> SORT_DESC],
        ];

        $dataProvider->sort->attributes['transactions'] = [
            'asc' => ['transactions.transaction_value'=> SORT_ASC],
            'desc' => ['transactions.transaction_value'=> SORT_DESC],
        ];

        $this->load($params);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }

        // grid filtering conditions
        $query->andFilterWhere([
            'account_number_id' => $this->account_number_id,
            'opening_date' => $this->opening_date,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['ilike', 'account_name', $this->account_name])
            ->andFilterWhere(['like', 'user.email', $this->user]);
//            ->andFilterWhere(['like', 'transactions.transaction_value', $this->transactions]);
        return $dataProvider;
    }
}
