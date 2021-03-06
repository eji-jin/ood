<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reference".
 *
 * @property int $id
 * @property int $deal_id
 * @property int $protocol_id
 * @property string $number
 * @property string $evidence Вещественные доказательства
 * @property string $claim Заявлялся ли гражд. иск
 * @property string $securofclaim Меры обесп. гражд. иска
 * @property string $guarantee Обеспеч. прав иждевенцев
 * @property string $cost Издержки
 * @property string $lawyer Защитник
 * @property string $dateofreview Дата ознакомления
 * @property string $excircum Смягчающие
 * @property string $aggcircum Отягчающие
 *
 * @property Deal $deal
 */
class Reference extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reference';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deal_id', 'protocol_id'], 'required'],
            [['deal_id', 'protocol_id'], 'integer'],
            [['number', 'evidence', 'claim', 'securofclaim', 'guarantee', 'cost', 'lawyer', 'dateofreview', 'excircum', 'aggcircum'], 'string'],
            [['deal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deal::className(), 'targetAttribute' => ['deal_id' => 'id']],
            [['protocol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Protocol::className(), 'targetAttribute' => ['protocol_id' => 'id']],
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
            'protocol_id' => 'Protocol ID',
            'number' => 'Номер дела',
            'evidence' => 'Вещественные доказательства',
            'claim' => 'Заявлялся ли гражданский иск',
            'securofclaim' => 'Мера процессуального принуждения',
            'guarantee' => 'Меры обеспечения прав иждивенцев',
            'cost' => 'Процессуальные издержки',
            'lawyer' => 'Защитник',
            'dateofreview' => 'Дата ознакомления',
            'excircum' => 'Смягчающие обстоятельства',
            'aggcircum' => 'Отягчающие обстоятельства',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'deal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProtocol()
    {
        return $this->hasOne(Protocol::className(), ['id' => 'protocol_id']);
    }
}
