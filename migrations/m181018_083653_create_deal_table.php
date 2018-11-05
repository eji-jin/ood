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
            'number' => $this->integer()->comment('Номер дела'),
            //Данные следователя
            'position' => $this->text() ->comment('Должность'),
            'rank' => $this->text()->comment('Звание'),
            'name' => $this->text()->comment('Ф.И.О. дознавателя'),
            'officer' =>$this->text()->comment('Подразделение'),
            'area_code' =>$this->text()->comment('Район'),

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
