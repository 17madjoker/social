<?php

use yii\db\Migration;
use backend\models\User;

class m180324_171946_create_rbac_data extends Migration
{

    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $viewComplaintsPermission = $auth->createPermission('viewComplaintsList');
        $auth->add($viewComplaintsPermission);

        $viewPostPermission = $auth->createPermission('viewPost');
        $auth->add($viewPostPermission);

        $deletePostPermission = $auth->createPermission('deletePost');
        $auth->add($deletePostPermission);

        $approvePostPermission = $auth->createPermission('approvePost');
        $auth->add($approvePostPermission);

        $viewUsersListPermission = $auth->createPermission('viewUsersList');
        $auth->add($viewUsersListPermission);

        $viewUserPermission = $auth->createPermission('viewUser');
        $auth->add($viewUserPermission);

        $deleteUserPermission = $auth->createPermission('deleteUser');
        $auth->add($deleteUserPermission);

        $updateUserPermission = $auth->createPermission('updateUser');
        $auth->add($updateUserPermission);

        //Define roles

        $moderatorRole = $auth->createRole('moderator');
        $auth->add($moderatorRole);

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        // Define roles - permissions relations

        $auth->addChild($moderatorRole, $viewComplaintsPermission);
        $auth->addChild($moderatorRole, $viewPostPermission);
        $auth->addChild($moderatorRole, $deletePostPermission);
        $auth->addChild($moderatorRole, $approvePostPermission);
        $auth->addChild($moderatorRole, $viewUsersListPermission);
        $auth->addChild($moderatorRole, $viewUserPermission);

        $auth->addChild($adminRole, $moderatorRole);
        $auth->addChild($adminRole, $deleteUserPermission);
        $auth->addChild($adminRole, $updateUserPermission);

        // Create admin user

        $user = new User([
            'email' => 'admin@mail.ru',
            'username' => 'ADmin',
            'password_hash' => '$2y$13$p9J682tWLCBD2C0rKkpzMO0SPXlL9UdKCSoMPVqO0gXVu/J0BK3FW'
        ]);
        $user->generateAuthKey();
        $user->save();

        $auth->assign($adminRole, $user->getId());

    }

    public function safeDown()
    {

    }

}
