<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document1".
 *
 * @property int $id
 * @property int $number Номер документа
 * @property string $name Ф.И.О.
 * @property string $workplace Место работы
 * @property string $post Должность
 * @property string $for Место представления справки
 */
class Document1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'name', 'workplace', 'post', 'for'], 'required'],
            [['number'], 'integer'],
            [['name', 'workplace', 'post', 'for'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер документа',
            'name' => 'Ф.И.О.',
            'workplace' => 'Место работы',
            'post' => 'Должность',
            'for' => 'Место представления справки',
        ];
    }
}
