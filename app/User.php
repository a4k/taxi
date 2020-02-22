<?php

class User extends Store {

    const ADMIN = 'ADMIN';
    const CLIENT = 'CLIENT';
    const DRIVER = 'DRIVER';

    public function __construct()
    {
        parent::__construct();
    }

    public static function getUserByLogin($login) {
        global $RESULT;

        foreach ($RESULT['users'] as $user) {
            if($user['login'] === $login) return $user;
        }

        return false;
    }

    public static function isAdmin($login) {
        $user = self::getUserByLogin($login);
        if($user && $user['group_id'] == self::ADMIN) {
            return true;
        }
        return false;
    }

    public static function isDriver($login) {
        $user = self::getUserByLogin($login);
        if($user && $user['group_id'] == self::DRIVER) {
            return true;
        }
        return false;
    }

    public function isClient($login) {
        $user = self::getUserByLogin($login);
        if($user && $user['group_id'] == self::CLIENT) {
            return true;
        }
        return false;
    }

    public static function auth($login) {
        if(isset($login)) {
            if(strlen($login) > 1) {
                setcookie('user', $login, time() + 60 * 60 * 30);
            } else {
                setcookie('user', '', time() - 60 * 60 * 30);
            }
        }
    }

}