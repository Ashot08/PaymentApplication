<?php

use yii\db\Migration;

/**
 * Class m180701_074940_AddRoles
 */
class m180701_074940_AddRoles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $rbac = \Yii::$app->authManager;

        $guest = $rbac->createRole('guest');
        $guest->description = 'Посетитель';
        $rbac->add($guest);

        $client = $rbac->createRole('client');
        $client->description = 'Контрагент';
        $rbac->add($client);

        $admin = $rbac->createRole('admin');
        $admin->description = 'Администратор';
        $rbac->add($admin);

        $rbac->addChild($admin, $client);
        $rbac->addChild($client, $guest);

        $adminPermission = $rbac->createPermission('admin permission');
        $adminPermission->description = 'Доступ к админке';
        $rbac->add($adminPermission);
        $rbac->addChild($admin, $adminPermission);

        $rbac->assign(
            $admin,
            backend\models\Admin::findOne([
                'username' => 'admin'])->id
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $manager = \Yii::$app->authManager;
        $manager->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180701_074940_AddRoles cannot be reverted.\n";

        return false;
    }
    */
}
