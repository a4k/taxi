<?php

use yii\db\Migration;

/**
 * Class m200222_152311_orders
 */
class m200222_152311_orders extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'from' => $this->string(),
            'to' => $this->string(),
            'total' => $this->integer(),
            'drive_class' => $this->string(),
            'status' => $this->string()->defaultValue('FREE'),
            'user_id' => $this->integer(),
            'phone' => $this->string(),
            'driver_id' => $this->integer(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

    }

    public function down()
    {

        $this->dropTable('orders');

    }
}
