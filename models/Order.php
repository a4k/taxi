<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Order extends ActiveRecord
{
    const STATUS_FREE = 'FREE';
    const STATUS_DRIVER_WAITING = 'DRIVER_WAITING';
    const STATUS_PASSENGER_WAITING = 'PASSENGER_WAITING';
    const STATUS_DRIVING = 'DRIVING';
    const STATUS_FINISH = 'FINISH';

    const TYPE_ECONOM = 'ECONOM';
    const TYPE_COMFORT = 'COMFORT';
    const TYPE_CHILDREN = 'CHILDREN';


    public static function getStatus($name)
    {
        $ar = [
            self::STATUS_FREE => 'Подбираем подходящего водителя',
            self::STATUS_DRIVER_WAITING => 'Ожидайте водителя',
            self::STATUS_PASSENGER_WAITING => 'Вас ожидает водитель',
            self::STATUS_DRIVING => 'В пути',
            self::STATUS_FINISH => 'Выполнен',
        ];
        return $ar[$name];
    }
    public static function getStatusForDriver($name)
    {
        $ar = [
            self::STATUS_FREE => 'Заказ доступен для выбора',
            self::STATUS_DRIVER_WAITING => 'Клиент ожидает',
            self::STATUS_PASSENGER_WAITING => 'Ожидайте пассажира',
            self::STATUS_DRIVING => 'В пути',
            self::STATUS_FINISH => 'Выполнен',
        ];
        return $ar[$name];
    }

    public static function getDriveClass($name)
    {
        $ar = [
            self::TYPE_ECONOM => 'Эконом',
            self::TYPE_COMFORT => 'Комфорт',
            self::TYPE_CHILDREN => 'Детский',
        ];
        return $ar[$name];
    }

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
