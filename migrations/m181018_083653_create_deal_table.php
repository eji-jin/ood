<?php

use yii\db\Migration;

/**
 * Handles the creation of table `deal`.
 */
class m181018_083653_create_deal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('deal', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'field_1' => $this->string(),
            'field_2' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('deal');
    }
}
