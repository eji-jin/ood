<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181006_105909_create_user_table extends Migration
{

    public function up()
    {
        $this->createTable('user', [
            'id'          => $this->primaryKey(),
            'username'    => $this->char(255)->comment('Имя пользователя'),
            'password'    => $this->char(255)->comment('Пароль'),
            'displayname' => $this->char(255)->comment('Ф.И.О'),
            'role'        => $this->char(255)->comment('Роль'),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->insert('user',[
            'username' => 'admin',
            'password' => 'admin',
            'displayname' => 'Администратор',
            'role' => 'admin'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
