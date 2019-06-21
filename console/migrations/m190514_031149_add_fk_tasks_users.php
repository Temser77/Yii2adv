<?php

use yii\db\Migration;

/**
 * Class m190514_031149_add_fk_tasks_users
 */
class m190514_031149_add_fk_tasks_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_tasks_users_creator_id','tasks','creator_id','users', 'id');
        $this->addForeignKey('fk_tasks_users_responsible_id','tasks','responsible_id','users', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_tasks_users_creator_id','tasks');
        $this->dropForeignKey('fk_tasks_users_responsible_id','tasks');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190514_031149_add_fk_tasks_users cannot be reverted.\n";

        return false;
    }
    */
}
