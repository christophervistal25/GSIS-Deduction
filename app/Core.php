<?php
namespace App;

class Core
{
    protected static $requestMethod;
    
    public static function getRequestMethod()
    {
        return mb_strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public static function getRequestUri()
    {
        return ltrim($_SERVER['REQUEST_URI'], '/');
    }

}