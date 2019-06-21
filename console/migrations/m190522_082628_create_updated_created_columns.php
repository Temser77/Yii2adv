<?php

use yii\db\Migration;

/**
 * Class m190522_082628_create_updated_created_columns
 */
class m190522_082628_create_updated_created_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'created', $this->dateTime());
        $this->addColumn('tasks', 'updated', $this->dateTime());
        $this->addColumn('users', 'created', $this->dateTime());
        $this->addColumn('users', 'updated', $this->dateTime());
        $this->addColumn('statuses', 'created', $this->dateTime());
        $this->addColumn('statuses', 'updated', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'created');
        $this->dropColumn('tasks', 'updated');
        $this->dropColumn('users', 'created');
        $this->dropColumn('users', 'updated');
        $this->dropColumn('statuses', 'created');
        $this->dropColumn('statuses', 'updated');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190522_082628_create_updated_created_columns cannot be reverted.\n";

        return false;
    }
    */
}
