<?php

use yii\db\Migration;

/**
 * Class m180701_082515_AddTransactionTable
 */
class m180701_082515_AddTransactionTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%transaction}}',
            [
                'transaction_number' => $this->primaryKey()->comment('Primary key'),
                'account_number' => $this->integer('16'),
                'recipient' => $this->integer('16'),
                'transaction_value' => $this->integer()->notNull(),
                'date' => $this->dateTime(),
                'comment' => $this->text(),
            ]
        );
        $this->addForeignKey(
            'account_number',
            'transaction',
            'account_number',
            'account',
            'account_number_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180701_082515_AddTransactionTable cannot be reverted.\n";

        return false;
    }
    */
}
