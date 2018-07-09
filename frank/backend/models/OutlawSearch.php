<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Outlaw;

/**
 * OutlawSearch represents the model behind the search form of `backend\models\Outlaw`.
 */
class OutlawSearch extends Outlaw
{
    /**
     * {@inheritdoc}
     */
    public $user;
    public function rules()
    {
        return [
            [['owtlaw_id', 'user_id'], 'integer'],
            [['user'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Outlaw::find();
        $query->joinWith(['user']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['user'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
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
            'owtlaw_id' => $this->owtlaw_id,
            'user_id' => $this->user_id,
        ])
            ->andFilterWhere(['like', 'user.username', $this->user]);

        return $dataProvider;
    }
}
