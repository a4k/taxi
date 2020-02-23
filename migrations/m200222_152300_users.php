<?php

use yii\db\Migration;

/**
 * Handles the creation for table `users`.
 * Has foreign keys to the tables:
 *
 * - `groups`
 */
class m200222_152300_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200222_152300_users cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'login' => $this->string(),
            'password' => $this->string(),
            'photo' => $this->string(),
            'group_id' => $this->integer(),
        ]);

    }

    public function down()
    {

        $this->dropTable('users');

        return false;
    }

}
