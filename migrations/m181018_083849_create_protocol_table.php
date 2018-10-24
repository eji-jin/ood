<?php

use yii\db\Migration;

/**
 * Handles the creation of table `protocol`.
 * Has foreign keys to the tables:
 *
 * - `deal`
 */
class m181018_083849_create_protocol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('protocol', [

            'id' => $this->primaryKey(),
            'deal_id' => $this->integer()->notNull(),
            'timeStart' => $this->text()->comment('Время начала допроса'),
            'timeStop' => $this->text()->comment('Время конца допроса'),
            'roleInThis' => $this->text()->comment('Роль допрашиваемого'),
            'createdate' => $this->text() ->comment('Дата допроса'),
            'city' => $this->text() ->comment('Населенный пункт'),
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
            'other' => $this->text()->comment('Иные данные'),
            'otherPerson' => $this->text()->comment('Другие присутствующие'),
            'hardware' => $this->text()->comment('Тех средства'),
            'incriminate' => $this->text()->comment('В чем подозревается'),
            'indications' => $this->text()->comment('Показания допрашиваемого'),

        ]);

        // creates index for column `deal_id`
        $this->createIndex(
            'idx-protocol-deal_id',
            'protocol',
            'deal_id'
        );

        // add foreign key for table `deal`
        $this->addForeignKey(
            'fk-protocol-deal_id',
            'protocol',
            'deal_id',
            'deal',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `deal`
        $this->dropForeignKey(
            'fk-protocol-deal_id',
            'protocol'
        );

        // drops index for column `deal_id`
        $this->dropIndex(
            'idx-protocol-deal_id',
            'protocol'
        );

        $this->dropTable('protocol');
    }
}
