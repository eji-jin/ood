<?php

use yii\db\Migration;

/**
 * Handles the creation of table `indictment_protocol`.
 * Has foreign keys to the tables:
 *
 * - `indictment`
 * - `protocol`
 */
class m181030_191021_create_junction_table_for_indictment_and_protocol_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('indictment_protocol', [
            'indictment_id' => $this->integer(),
            'protocol_id' => $this->integer(),
            'value' => $this->string(),
            'otyagch' => $this->string(),
            'smyagch' => $this->string(),

            'costs' => $this->string(),
            'mera_prin' => $this->string(),
            'PRIMARY KEY(indictment_id, protocol_id)',
        ]);

        // creates index for column `indictment_id`
        $this->createIndex(
            'idx-indictment_protocol-indictment_id',
            'indictment_protocol',
            'indictment_id'
        );

        // add foreign key for table `indictment`
        $this->addForeignKey(
            'fk-indictment_protocol-indictment_id',
            'indictment_protocol',
            'indictment_id',
            'indictment',
            'id',
            'CASCADE'
        );

        // creates index for column `protocol_id`
        $this->createIndex(
            'idx-indictment_protocol-protocol_id',
            'indictment_protocol',
            'protocol_id'
        );

        // add foreign key for table `protocol`
        $this->addForeignKey(
            'fk-indictment_protocol-protocol_id',
            'indictment_protocol',
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
        // drops foreign key for table `indictment`
        $this->dropForeignKey(
            'fk-indictment_protocol-indictment_id',
            'indictment_protocol'
        );

        // drops index for column `indictment_id`
        $this->dropIndex(
            'idx-indictment_protocol-indictment_id',
            'indictment_protocol'
        );

        // drops foreign key for table `protocol`
        $this->dropForeignKey(
            'fk-indictment_protocol-protocol_id',
            'indictment_protocol'
        );

        // drops index for column `protocol_id`
        $this->dropIndex(
            'idx-indictment_protocol-protocol_id',
            'indictment_protocol'
        );

        $this->dropTable('indictment_protocol');
    }
}
