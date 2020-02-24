<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * OrderForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class OrderForm extends Model
{
    public $from;
    public $to;
    public $phone;
    public $drive_class;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['from', 'trim'],
            ['from', 'required', 'message' => 'Заполните откуда'],
            ['from', 'string', 'min' => 2, 'max' => 255],

            ['to', 'trim'],
            ['to', 'required', 'message' => 'Заполните куда'],
            ['to', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required', 'message' => 'Заполните телефон'],
            ['phone', 'string', 'min' => 2, 'max' => 255],

            ['drive_class', 'string'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function order()
    {
        if (!$this->validate()) {
            return null;
        }
        $userId = Yii::$app->user->identity->getId();

        $order = new Order();
        $order->user_id = $userId;
        $order->phone = $this->phone;
        $order->from = $this->from;
        $order->to = $this->to;
        $order->drive_class = $this->drive_class;
        $order->updated_at = mktime();
        return $order->save();

    }
}
