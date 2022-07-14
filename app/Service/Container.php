<?php
namespace App\Service;

use ReflectionClass;

class Container
{
    private static $container = [];
    
    public static function make(string $abstract)
    {
        if (!isset(self::$container[$abstract])) {
            self::$container[$abstract] = new ($abstract);
        } 
        return self::$container[$abstract];
    }
}