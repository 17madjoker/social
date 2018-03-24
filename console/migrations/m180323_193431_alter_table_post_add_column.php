<?php

use yii\db\Migration;

/**
 * Class m180323_193431_alter_table_post_add_column
 */
class m180323_193431_alter_table_post_add_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post','complaints',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post','complaints');
    }
}
