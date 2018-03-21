<?php

use yii\db\Migration;

/**
 * Class m180321_085332_alter_user_table
 */
class m180321_085332_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','about',$this->text());
        $this->addColumn('user','type',$this->integer(3));
        $this->addColumn('user','nickname',$this->string(70));
        $this->addColumn('user','picture',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','about');
        $this->dropColumn('user','type');
        $this->dropColumn('user','nickname');
        $this->dropColumn('user','picture');
    }

}
