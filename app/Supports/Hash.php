<?php

namespace App\Supports;

use App\Contracts\IHash;

class Hash implements IHash
{
    public static function make($value, $options = [])
    {
        return password_hash($value, PASSWORD_BCRYPT, $options);
    }
    
    public static function check($value, $hashedValue, $options = [])
    {
        return password_verify($value, $hashedValue);
    }
}