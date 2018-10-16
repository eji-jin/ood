<?php

use yii\db\Migration;

/**
 * Class m181006_053109_create_table_document1
 */
class m181006_053109_create_table_document1 extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('document1', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->comment('Номер документа'),
            'name' => $this->text()->comment('Ф.И.О.'),
            'workplace' => $this->text()->comment('Место работы'),
            'post' => $this->text()->comment('Должность'),
            'for' => $this->text()->comment('Место представления справки'),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable('document1');
    }

}
