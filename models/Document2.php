<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document2".
 *
 * @property int $id
 * @property string $createdate Дата допроса
 * @property int $number Номер дела
 * @property string $rank Звание
 * @property string $name Ф.И.О. дознавателя
 * @property string $room № кабинета
 * @property string $suspect Ф.И.О. допрашиваемого
 * @property string $birthdate Дата рождения
 * @property string $birthplace Место рождения
 * @property string $residence Проживает
 * @property string $nat Гражданство
 * @property string $educat Образование
 * @property string $famstat Сем. положение
 * @property string $workplace Место работы, учебы
 * @property string $duty Воинская обязанность
 * @property string $crime Судимости
 * @property string $pasport Док-т удост. личн.
 */
class Document2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdate', 'rank', 'name', 'room', 'suspect', 'birthdate', 'birthplace', 'residence', 'nat', 'educat', 'famstat', 'workplace', 'duty', 'crime', 'pasport'], 'string'],
            [['number'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createdate' => 'Дата создания',
            'number' => 'Номер дела',
            'rank' => 'Звание дознавателя',
            'name' => 'Имя дознавателя',
            'room' => 'Помещение',
            'suspect' => 'Ф.И.О. допрашиваемого',
            'birthdate' => 'Дата рождения',
            'birthplace' => 'Место рождения',
            'residence' => 'Место жительсва или проживания',
            'nat' => 'Гражданство',
            'educat' => 'Образование',
            'famstat' => 'Семейный статус, состав семьи',
            'workplace' => 'Место работы или учебыы',
            'duty' => 'Отношение к воинской обязанности',
            'crime' => 'Наличие судимости',
            'pasport' => 'Паспорт или иной документ, удостоверяющий личность подозреваемого',
        ];
    }
}
