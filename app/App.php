<?php

class App
{
    protected static $settings;
    protected static $conn;

    public function __construct($settings)
    {
        self::$settings = $settings;
    }

    public static function getSettings()
    {
        return self::$settings;
    }

    public static function getConnection()
    {
        if (self::$conn) return self::$conn;

        $dbSettings = self::$settings['DB'];
        self::$conn = new PDO("mysql:host=localhost;dbname={$dbSettings['dbname']}",
            $dbSettings['username'], $dbSettings['password']);
        return self::$conn;
    }

    public static function getPublicDir()
    {
        global $SITE_DIR;

        return $SITE_DIR . '/public';
    }

    public static function getTemplatesDir()
    {
        return self::getPublicDir() . '/templates';
    }
}