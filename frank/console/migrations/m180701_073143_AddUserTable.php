<?php

use yii\db\Migration;

/**
 * Class m180701_073143_AddUserTable
 */
class m180701_073143_AddUserTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->comment('Первичный ключ'),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->integer()->notNull()->defaultValue(common\models\User::STATUS_ACTIVE),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180701_073143_AddUserTable cannot be reverted.\n";

        return false;
    }
    */
}
