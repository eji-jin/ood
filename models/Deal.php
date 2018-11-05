<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deal".
 *
 * @property int $id
 * @property int $number
 * @property string position
 * @property string rank
 * @property string name
 * @property string officer
 * @property string area_code
 * @property Protocol[] $protocols
 */
class Deal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number'], 'integer'],
            [['number', 'name'], 'required'],
            [['position', 'rank', 'name', 'officer','area_code'], 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер дела',
            'position' => 'Должность',
            'rank' => 'Звание',
            'name' => 'ФИО',
            'officer' => 'Подразделение',
            'area_code'=>'Район',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProtocols()
    {
        return $this->hasMany(Protocol::className(), ['deal_id' => 'id']);
    }
}
