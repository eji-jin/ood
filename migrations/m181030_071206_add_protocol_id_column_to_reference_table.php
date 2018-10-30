<?php

use yii\db\Migration;

/**
 * Handles adding protocol_id to table `reference`.
 * Has foreign keys to the tables:
 *
 * - `protocol`
 */
class m181030_071206_add_protocol_id_column_to_reference_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('reference', 'protocol_id', $this->integer()->notNull());

        // creates index for column `protocol_id`
        $this->createIndex(
            'idx-reference-protocol_id',
            'reference',
            'protocol_id'
        );

        // add foreign key for table `protocol`
        $this->addForeignKey(
            'fk-reference-protocol_id',
            'reference',
            'protocol_id',
            'protocol',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `protocol`
        $this->dropForeignKey(
            'fk-reference-protocol_id',
            'reference'
        );

        // drops index for column `protocol_id`
        $this->dropIndex(
            'idx-reference-protocol_id',
            'reference'
        );

        $this->dropColumn('reference', 'protocol_id');
    }
}
