<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "protocol".
 *
 * @property int $id
 * @property int $deal_id
 * @property string $field_1
 * @property string $field_2
 *
 * @property Deal $deal
 */
class Protocol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'protocol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deal_id'], 'required'],
            [['deal_id'], 'integer'],
            [['field_1', 'field_2'], 'string', 'max' => 255],
            [['deal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deal::className(), 'targetAttribute' => ['deal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'deal_id' => 'Deal ID',
            'field_1' => 'Field 1',
            'field_2' => 'Field 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'deal_id']);
    }
}
