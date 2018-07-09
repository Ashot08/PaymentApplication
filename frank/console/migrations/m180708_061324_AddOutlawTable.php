<?php

use yii\db\Migration;

/**
 * Class m180708_061324_AddOutlawTable
 */
class m180708_061324_AddOutlawTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%outlaw}}', [
            'owtlaw_id' => $this->primaryKey()->comment('Первичный ключ'),
            'user_id' => $this->integer()->notNull()->unique(),
        ]);
        $this->addForeignKey(
            'user_id',
            'outlaw',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%outlaw}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180708_061324_AddOutlawTable cannot be reverted.\n";

        return false;
    }
    */
}
