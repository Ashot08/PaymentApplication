<?php

use yii\db\Migration;

/**
 * Class m180703_115015_AddAdminTable
 */
class m180701_073144_AddAdminTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey()->comment('Первичный ключ'),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->integer()->notNull()->defaultValue(common\models\User::STATUS_ACTIVE),
        ]);

        $this->insert('{{%admin}}', [
            'id' => 1,
            'username' => 'admin',
            'password_hash' =>'$2y$13$d4s7Vbbvoo5ujH7SFfsdFuAOVhPZF.e2Z2u73IDTay7b8omUQcxOi',
            'email' => 'admin@mail.ru',
            'status' => 1]);
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'Corporation',
            'password_hash' =>'$2y$13$d4s7Vbbvoo5ujH7SFfsdFuAOVhPZF.e2Z2u73IDTay7b8omUQcxOi',
            'email' => 'corporation@mail.ru',
            'status' => 1]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180703_115015_AddAdminTable cannot be reverted.\n";

        return false;
    }
    */
}
