<?php
namespace App\Supports;

class Str
{
    public static function contains($haystack, $find) : bool
    {
        return strpos($haystack, $find) !== false;
    }
}