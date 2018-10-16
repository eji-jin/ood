<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Document2;

/**
 * Doc2Search represents the model behind the search form of `app\models\Document2`.
 */
class Doc2Search extends Document2
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number'], 'integer'],
            [['createdate', 'rank', 'name', 'room', 'suspect', 'birthdate', 'birthplace', 'residence', 'nat', 'educat', 'famstat', 'workplace', 'duty', 'crime', 'pasport'], 'safe'],
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
        $query = Document2::find();

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

        $query->andFilterWhere(['like', 'createdate', $this->createdate])
            ->andFilterWhere(['like', 'rank', $this->rank])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'room', $this->room])
            ->andFilterWhere(['like', 'suspect', $this->suspect])
            ->andFilterWhere(['like', 'birthdate', $this->birthdate])
            ->andFilterWhere(['like', 'birthplace', $this->birthplace])
            ->andFilterWhere(['like', 'residence', $this->residence])
            ->andFilterWhere(['like', 'nat', $this->nat])
            ->andFilterWhere(['like', 'educat', $this->educat])
            ->andFilterWhere(['like', 'famstat', $this->famstat])
            ->andFilterWhere(['like', 'workplace', $this->workplace])
            ->andFilterWhere(['like', 'duty', $this->duty])
            ->andFilterWhere(['like', 'crime', $this->crime])
            ->andFilterWhere(['like', 'pasport', $this->pasport]);

        return $dataProvider;
    }
}
