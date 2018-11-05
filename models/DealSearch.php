<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Deal;

/**
 * DealSearch represents the model behind the search form of `app\models\Deal`.
 */
class DealSearch extends Deal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number'], 'integer'],
            [['position', 'rank', 'name', 'officer', 'deal_area'], 'string'],

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
        $query = Deal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'number' => $this->number,
        ]);

        $query->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'rank', $this->rank])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'deal_area', $this->name])
            ->andFilterWhere(['like', 'officer', $this->officer]);

        return $dataProvider;
    }
}
