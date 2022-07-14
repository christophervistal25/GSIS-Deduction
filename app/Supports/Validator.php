<?php
namespace App\Supports;

use App\Models\User;
use App\Supports\Str;

class Validator
{
    public static $errors = [];

    public static function make(array $data = [], array $rules = []) :Object
    {
        $rules = array_filter($rules);
        
        foreach($rules as $field => $rule) {
            foreach($rule as $r) {
                if(Str::contains($r, ':')) {
                    list($method, $table) = explode(":", $r);
                    self::$method($table, $field, $data[$field]);
                } else {
                    self::$r($data[$field], $field);
                }
            }
        }

        return new static;
    }

    private static function required($fieldValue, $field) :void
    {
        if(empty($fieldValue)) {
            self::$errors[$field][] = "{$field} is required";
        }
    }

    private static function exists(string $constraints, string $field, string $fieldValue)
    {
        list($table, $column) = explode(",", $constraints);
         if(!User::where($column, $fieldValue)->exists()) {
            self::$errors[$field][] = "{$field} does not exist";
         }
    }

    public static function fail() :bool
    {
        // Set the error message in the session
        return empty(self::$errors) ? false : true;
    }
}