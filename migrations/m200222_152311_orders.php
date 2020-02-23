<?php

use yii\db\Migration;

/**
 * Class m200222_152311_orders
 */
class m200222_152311_orders extends Migration
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
        echo "m200222_152311_orders cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'from' => $this->string(),
            'to' => $this->string(),
            'total' => $this->integer(),
            'drive_class_id' => $this->integer(),
            'driver_id' => $this->integer(),
            'status' => $this->string()->defaultValue('FREE'),
            'updated_at' => $this->integer(),
        ]);

    }

    public function down()
    {

        $this->dropTable('orders');

        return false;
    }
}