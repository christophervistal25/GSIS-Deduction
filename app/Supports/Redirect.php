<?php
namespace App\Supports;

use Exception;

class Redirect
{
    public static function to(string $url)
    {
        header("Location: {$url}");
    }
    

}