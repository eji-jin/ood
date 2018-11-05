<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reference;

/**
 * ReferenceSearch represents the model behind the search form of `app\models\Reference`.
 */
class ReferenceSearch extends Reference
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'deal_id'], 'integer'],
            [['number', 'evidence', 'claim', 'securofclaim', 'guarantee', 'cost', 'lawyer', 'dateofreview', 'excircum', 'aggcircum'], 'safe'],
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
        $query = Reference::find();

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
            'deal_id' => $this->deal_id,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'evidence', $this->evidence])
            ->andFilterWhere(['like', 'claim', $this->claim])
            ->andFilterWhere(['like', 'securofclaim', $this->securofclaim])
            ->andFilterWhere(['like', 'guarantee', $this->guarantee])
            ->andFilterWhere(['like', 'cost', $this->cost])
            ->andFilterWhere(['like', 'lawyer', $this->lawyer])
            ->andFilterWhere(['like', 'dateofreview', $this->dateofreview]);

        return $dataProvider;
    }
}
