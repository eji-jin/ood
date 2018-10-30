<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "protocol".
 *
 * @property int $id
 * @property int $deal_id
 * @property string $timeStart
 * @property string $timeStop
 * @property string $roleInThis
 * @property string $createdate
 * @property string $city
 * @property string $room
 * @property string $suspect
 * @property string $birthdate
 * @property string $nat
 * @property string $educat
 * @property string $famstat
 * @property string $workplace
 * @property string $duty
 * @property string $otherPerson
 * @property string $hardware
 * @property string $incriminate
 * @property string $birthplace
 * @property string $residence
 * @property string $crime
 * @property string $pasport
 * @property string $other
 * @property string $indications
 
 
  * @property string $evidence
 * @property string $claim
 * @property string $securofclaim
 * @property string $guarantee
 * @property string $cost
 * @property string $lawyer
 * @property string $dateofreview
 
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
            [['dopstat', 'dopstattext', 'mp', 'evidence', 'claim', 'securofclaim', 'guarantee', 'cost', 'lawyer', 'dateofreview', 'sent', 'birthplace', 'residence', 'crime', 'pasport', 'other', 'indications'], 'string'],
            [['timeStart', 'timeStop', 'roleInThis', 'createdate', 'city', 'room', 'suspect', 'birthdate', 'nat', 'educat', 'famstat', 'workplace', 'duty', 'otherPerson', 'hardware', 'incriminate'], 'string'],

              
            
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
            'deal_id' => 'Номер дела',
            'timeStart' => 'Время начала допроса',
            'timeStop' => 'Время окончания допроса',
            'roleInThis' => 'Роль в деле',
            'createdate' => 'Дата допроса',
            'city' => 'Нас. пункт',
            'room' => 'Помещение',
            'suspect' => 'ФИО допрашиваемого',
            'birthdate' => 'Дата рождения',
            'nat' => 'Гражданство',
            'educat' => 'Образование',
            'famstat' => 'Семейное положение',
            'workplace' => 'Место работы',
            'duty' => 'Воинск. обяз.',
            'otherPerson' => 'Др. присутствующие',
            'hardware' => 'Тех. ср-ва',
            'incriminate' => 'Преступление',
            'birthplace' => 'Место рождения',
            'residence' => 'Место проживания',
            'crime' => 'Судимости',
            'pasport' => 'Док-т удост. личн.',
            'other' => 'Др. данные',
            'indications' => 'Показания',
            'dopstat' =>'Поступившие заявления',
            'dopstattext'=>'Содержание заявлений',

            //Справка
            'evidence' => 'Вещественные доказательства',
            'claim' => 'гражд иск',
            'securofclaim'=> 'обесп гражд иска', 
            'guarantee' => 'Гарантии иждевенцев',
            'cost' => 'Издержки',
            'lawyer' => 'Защитник',
            'dateofreview'=> 'Дата ознакомления',
            'sent' => 'Куда и когда нправлено',
            'mp' => 'Мера пресечения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['number' => 'deal_id']);
    }
}
