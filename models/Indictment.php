<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indictment".
 *
 * @property int $id
 * @property int $deal_id
 * @property string $number
 * @property string $area Район
 * @property string $title Звание прокурора
 * @property string $prosecutor ФИО прокурора
 * @property string $chiefposition Должность начальника
 * @property string $chiefrank Звание начальника
 * @property string $chiefname ФИО начальника
 * @property string $handinfo Информация из рукописных документов
 * @property string $resolution Информация из постановления о возб. угол. дела
 * @property string $expertise Информация из заключения экспертизы
 * @property string $eviden Доказательства
 * @property string $excircum Смягчающие
 * @property string $aggcircum Отягчающие
 *
 * @property Deal $deal
 */
class Indictment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indictment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deal_id'], 'required'],
            [['deal_id'], 'integer'],
            [['number', 'area', 'title', 'prosecutor', 'chiefposition', 'chiefrank', 'chiefname', 'handinfo', 'resolution', 'expertise', 'eviden', 'excircum', 'aggcircum'], 'string'],
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
            'number' => 'Number',
            'area' => 'Район',
            'title' => 'Должность прокурора',
            'prosecutor' => 'ФИО прокурора',
            'chiefposition' => 'Должность начальника',
            'chiefrank' => 'Звание начальника',
            'chiefname' => 'ФИО начальника',
            'handinfo' => 'Информация из рукописных источников',
            'resolution' => 'Постановление о возбуждении уголовного дела',
            'expertise' => 'Информация из заключения экспертизы',
            'eviden' => 'Доказательства',
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
}
