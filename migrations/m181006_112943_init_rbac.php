<?php

use yii\db\Migration;

/**
 * Class m181006_112943_init_rbac
 */
class m181006_112943_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        /*
         * Permissions
         */

        $useForms = $auth->createPermission('useForms');
        $useForms->description = 'пользоваться формами';
        $auth->add($useForms);

        $editUsers = $auth->createPermission('editUsers');
        $editUsers->description = 'редактироать пользователей';
        $auth->add($editUsers);

        /*
         * Roles
         */

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);
        $auth->addChild($user, $useForms);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);
        $auth->addChild($admin,$user);
        $auth->addChild($admin, $editUsers);
    }

    public function down()
    {
        echo "m181006_112943_init_rbac cannot be reverted.\n";

        return true;
    }
}
