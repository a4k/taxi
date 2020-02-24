<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUserId($user_id)
    {
        return static::findOne(['user_id' => $user_id]);
    }

    public static function findByDriverId($driver_id)
    {
        return static::findOne(['driver_id' => $driver_id]);
    }


    public function getId()
    {
        return $this->id;
    }

    public function getPhone()
    {
        return $this->phone;
    }

}
