<?php

use yii\db\Migration;

/**
 * Class m200222_152300_users
 */
class m200222_152300_users extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(),
            'username' => $this->string(),
            'password' => $this->string(),
            'photo' => $this->string(),
            'group_id' => $this->string()->defaultValue('CLIENT'),
            'access_token' => $this->string(),
        ]);

        $this->insert('users', [
            'phone' => 'admin',
            'username' => 'admin',
            'password' => 'admin',
            'group_id' => 'ADMIN',
        ]);

    }

    public function down()
    {

        $this->dropTable('users');

    }

}
