<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username Имя пользователя
 * @property string $password Пароль
 * @property string $displayname Ф.И.О
 * @property string $role Роль
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'displayname', 'role','area_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'displayname' => 'Ф.И.О',
            'role' => 'Роль',
            'area_code'=>'Район',
        ];
    }
}
