<?php

class App
{
    protected static $settings;

    public function __construct($settings)
    {
        self::$settings = $settings;
    }
}