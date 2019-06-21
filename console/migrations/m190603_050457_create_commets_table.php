<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%commets}}`.
 */
class m190603_050457_create_commets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'created' => $this->dateTime()->defaultExpression("now()"),
            'uploaded_file_path' => $this->string()
        ]);
        $this->addForeignKey('fk_comments_users_creator_id','comments','creator_id','users','id');
        $this->addForeignKey('fk_comments_tasks_task_id','comments','task_id','tasks','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
        $this->dropForeignKey('fk_comments_users_creator_id','comments');
        $this->dropForeignKey('fk_comments_tasks_task_id','comments');

    }
}
