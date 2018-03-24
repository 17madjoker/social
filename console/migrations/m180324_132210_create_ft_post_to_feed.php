<?php

use yii\db\Migration;

/**
 * Class m180324_132210_create_ft_post_to_feed
 */
class m180324_132210_create_ft_post_to_feed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-post-id',
            'post',
            'id',
            'feed',
            'post_id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-id',
            'post'
        );
    }

}
