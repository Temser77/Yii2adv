<?php

use yii\db\Migration;

/**
 * Class m190521_083401_create_email_column
 */
class m190521_083401_create_email_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users','email',$this->string(255));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users','email');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190521_083401_create_email_column cannot be reverted.\n";

        return false;
    }
    */
}
