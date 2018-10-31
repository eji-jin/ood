<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reference`.
 * Has foreign keys to the tables:
 *
 * - `deal`
 */
class m181018_083849_create_reference_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reference', [

            'id' => $this->primaryKey(),
            'deal_id' => $this->integer()->notNull(),
            'number' => $this->text(),
            
            'evidence' => $this->text()->comment('Вещественные доказательства'),
            'claim' => $this->text()->comment('Заявлялся ли гражд. иск'),
            'securofclaim' => $this->text()->comment('Меры обесп. гражд. иска'),
            'guarantee' => $this->text()->comment('Обеспеч. прав иждевенцев'),
            'cost' => $this->text()->comment('Издержки'),
            'lawyer' => $this->text()->comment('Защитник'),
            'dateofreview' => $this->text()->comment('Дата ознакомления'),
            
        ]);

        // creates index for column `deal_id`
        $this->createIndex(
            'idx-reference-deal_id',
            'reference',
            'deal_id'
        );

        // add foreign key for table `deal`
        $this->addForeignKey(
            'fk-reference-deal_id',
            'reference',
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
            'fk-reference-deal_id',
            'reference'
        );

        // drops index for column `deal_id`
        $this->dropIndex(
            'idx-reference-deal_id',
            'reference'
        );

        $this->dropTable('reference');
    }
}
