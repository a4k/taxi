<?php

use yii\db\Migration;

/**
 * Class m200222_152300_users
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

        $this->addForeignKey(
            'fk-users-group_id',
            'users',
            'group_id',
            'groups',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        // drops foreign key for table `groups`
        $this->dropForeignKey(
            'fk-users-group_id',
            'groups'
        );

        $this->dropTable('users');

        return false;
    }

}
