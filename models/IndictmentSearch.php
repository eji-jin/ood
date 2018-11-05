<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Indictment;

/**
 * IndictmentSearch represents the model behind the search form of `app\models\Indictment`.
 */
class IndictmentSearch extends Indictment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'deal_id'], 'integer'],
            [['number', 'area', 'title', 'prosecutor', 'chiefposition', 'chiefrank', 'chiefname', 'handinfo', 'resolution', 'expertise', 'eviden', 'excircum', 'aggcircum', 'date_indict', 'evidences'], 'safe'],
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
        $query = Indictment::find();

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
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'date_indict', $this->area])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'prosecutor', $this->prosecutor])
            ->andFilterWhere(['like', 'chiefposition', $this->chiefposition])
            ->andFilterWhere(['like', 'chiefrank', $this->chiefrank])
            ->andFilterWhere(['like', 'chiefname', $this->chiefname])
            ->andFilterWhere(['like', 'handinfo', $this->handinfo])
            ->andFilterWhere(['like', 'resolution', $this->resolution])
            ->andFilterWhere(['like', 'expertise', $this->expertise])
            ->andFilterWhere(['like', 'eviden', $this->eviden])
            ->andFilterWhere(['like', 'excircum', $this->excircum])
            ->andFilterWhere(['like', 'aggcircum', $this->aggcircum])


            ->andFilterWhere(['like', 'evidences', $this->evidences])
            ->andFilterWhere(['like', 'date_indict', $this->date_indict]);

        return $dataProvider;
    }
}
