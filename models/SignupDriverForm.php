<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignupDriverForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupDriverForm extends Model
{
    public $username;
    public $phone;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Заполните логин'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Пользователь с таким логином существует.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required', 'message' => 'Заполните телефон'],
            ['phone', 'string', 'max' => 255],
            ['phone', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Пользователь с таким телефоном существует.'],

            ['password', 'required', 'message' => 'Заполните пароль'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->group_id = User::GROUP_DRIVER;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save();

    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
