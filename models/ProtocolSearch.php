<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Protocol;

/**
 * ProtocolSearch represents the model behind the search form of `app\models\Protocol`.
 */
class ProtocolSearch extends Protocol
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'deal_id'], 'integer'],
            [['birthplace', 'residence', 'crime', 'pasport', 'other', 'indications'], 'string'],
            [['timeStart', 'timeStop', 'roleInThis', 'createdate', 'city', 'room', 'suspect', 'birthdate', 'nat', 'educat', 'famstat', 'workplace', 'duty', 'otherPerson', 'hardware', 'incriminate'], 'string'],

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
        $query = Protocol::find();

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

      //  $query->andFilterWhere(['like', 'field_1', $this->field_1])
     //       ->andFilterWhere(['like', 'field_2', $this->field_2]);

        return $dataProvider;
    }
}
