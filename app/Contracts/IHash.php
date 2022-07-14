<?php
namespace App\Contracts;

interface IHash
{
    public static function make($value, $options = []);
    public static function check($value, $hashedValue, $options = []);
}