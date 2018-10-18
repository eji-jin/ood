<?php

use yii\db\Migration;

/**
 * Class m181006_053109_create_table_document2
 */
class m181006_053109_create_table_document3 extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('document3', [
            'id' => $this->primaryKey(),
            'createdate' => $this->text() ->comment('Дата допроса'),
            'number' => $this->integer()->comment('Номер дела'),
            'rank' => $this->text()->comment('Звание'),
            'name' => $this->text()->comment('Ф.И.О. дознавателя'),
            'room' => $this->text()->comment('№ кабинета'),
            'suspect' => $this->text()->comment('Ф.И.О. допрашиваемого'),
            'birthdate' => $this->text()->comment('Дата рождения'),
            'birthplace' => $this->text()->comment('Место рождения'),
            'residence' => $this->text()->comment('Проживает'),
            'nat' => $this->text()->comment('Гражданство'),
            'educat' => $this->text()->comment('Образование'),
            'famstat' => $this->text()->comment('Сем. положение'),
            'workplace' => $this->text()->comment('Место работы, учебы'),
            'duty' => $this->text()->comment('Воинская обязанность'),
            'crime' => $this->text()->comment('Судимости'),
            'pasport' => $this->text()->comment('Док-т удост. личн.'),
            
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable('document2');
    }

}
