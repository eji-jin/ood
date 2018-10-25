<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deal".
 *
 * @property int $id
 * @property int $number
 * @property string $field_1
 * @property string $field_2
 *
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
            [['position', 'rank', 'name', 'officer'], 'string'],

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
