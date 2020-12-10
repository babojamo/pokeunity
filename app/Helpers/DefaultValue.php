<?php

namespace App\Helpers;

class DefaultValue
{
    /**
     * Default value setter takes two parameter
     * @param $value Value will be returned if has value
     * @param $default Value will be returned if first parameter is empty
     */
    public static function set($value,$default)
    { 
        return $value ?? $default;
    }
}
