<?php

use yii\db\Migration;

/**
 * Handles the creation of table `indictment`.
 * Has foreign keys to the tables:
 *
 * - `deal`
 */
class m181018_083849_create_indictment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('indictment', [

            'id' => $this->primaryKey(),
            'deal_id' => $this->integer()->notNull(),
            'number' => $this->text(),
            'date_indict' => $this->text(),
            //Прокурор
            'area' => $this->text()->comment('Район'),
            'title' => $this->text()->comment('Звание прокурора'),
            'prosecutor' => $this->text()->comment('ФИО прокурора'),
            //Начальник
            'chiefposition' => $this->text() ->comment('Должность начальника'),
            'chiefrank' => $this->text() ->comment('Звание начальника'),
            'chiefname' => $this->text()->comment('ФИО начальника'),
            //Информация из рукописных документов
            'handinfo' => $this->text()->comment('Информация из рукописных документов'),
            'resolution' => $this->text()->comment('Информация из постановления о возб. угол. дела'),
            'expertise' => $this->text()->comment('Информация из заключения экспертизы'),
            //Доказательства
            'eviden' => $this->text()->comment('Вещественные доказательства'),
            'evidences' => $this->text()->comment('Доказательства'),
            //Обстоятельства
            'excircum' => $this->text()->comment('Смягчающие'),
            'aggcircum' => $this->text()->comment('Отягчающие'),

        ]);

        // creates index for column `deal_id`
        $this->createIndex(
            'idx-indictment-deal_id',
            'indictment',
            'deal_id'
        );

        // add foreign key for table `deal`
        $this->addForeignKey(
            'fk-indictment-deal_id',
            'indictment',
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
            'fk-indictment-deal_id',
            'indictment'
        );

        // drops index for column `deal_id`
        $this->dropIndex(
            'idx-indictment-deal_id',
            'indictment'
        );

        $this->dropTable('indictment');
    }
}
