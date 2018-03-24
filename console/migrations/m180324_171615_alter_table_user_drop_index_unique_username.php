<?php

use yii\db\Migration;

/**
 * Class m180324_171615_alter_table_user_drop_index_unique_username
 */
class m180324_171615_alter_table_user_drop_index_unique_username extends Migration
{

    public function safeUp()
    {
        $this->dropIndex('username','user');
    }

    public function safeDown()
    {
        $this->createIndex('username','user','username',$unique = true);
    }

}
