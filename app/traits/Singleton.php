<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 04.10.2016
 * Time: 20:21
 */

namespace app\traits;


trait Singleton
{
    protected static $instance;

    protected function __construct()
    {
    }

    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}