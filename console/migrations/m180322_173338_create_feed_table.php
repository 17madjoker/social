<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feed`.
 */
class m180322_173338_create_feed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('feed', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'author_id' => $this->integer(),
            'author_name' => $this->string(),
            'author_nickname' => $this->integer(10),
            'author_picture' => $this->string(),
            'post_id' => $this->integer(),
            'post_filename' => $this->string()->notNull(),
            'post_description' => $this->text(),
            'post_created_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('feed');
    }
}
