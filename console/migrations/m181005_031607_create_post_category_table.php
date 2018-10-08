<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_category`.
 */
class m181005_031607_create_post_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post_category', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
        ]);

        // creates index for column `post_id`
        $this->createIndex(
            'idx-post_category-post_id',
            'post_category',
            'post_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-post_category-post_id',
            'post_category',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-post_category-category_id',
            'post_category',
            'category_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-post_category-category_id',
            'post_category',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post_category');
    }
}
