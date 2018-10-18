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
            'field_1' => $this->string(),
            'field_2' => $this->string(),
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
