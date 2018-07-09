<?php

use yii\db\Migration;

/**
 * Class m180701_081700_AddAccountTable
 */
class m180701_081700_AddAccountTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%account}}', [
            'account_number_id' => $this->primaryKey('16'),
            'account_name' => $this->string('48')->notNull(),
            'opening_date' => $this->dateTime(),
            'user_id' => $this->integer('16')->notNull(),
        ]);
        $this->addForeignKey(
            'user_id',
            'account',
            'user_id',
            'user',
            'id'
        );

        $this->insert('{{%account}}', [
            'account_number_id' => 1,
            'account_name' => 'Корпоративный счет №1',
            'opening_date' =>'2018-07-04 18:04:17',
            'user_id' => 1,
        ]);

        $this->insert('{{%account}}', [
            'account_number_id' => 2,
            'account_name' => 'Корпоративный счет №2',
            'opening_date' =>'2018-07-04 18:04:18',
            'user_id' => 1,
        ]);

        $this->insert('{{%account}}', [
            'account_number_id' => 3,
            'account_name' => 'Корпоративный счет №3',
            'opening_date' =>'2018-07-04 18:04:19',
            'user_id' => 1,
        ]);

        $this->insert('{{%account}}', [
            'account_number_id' => 0,
            'account_name' => 'Депозит',
            'opening_date' =>'2018-07-04 18:04:19',
            'user_id' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%account}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180701_081700_AddAccountTable cannot be reverted.\n";

        return false;
    }
    */
}
