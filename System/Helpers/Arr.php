<?php

class Arr
{
    public static function get($_array, $_key, $_default = null)
    {
        if (is_array($_array)) {
            if(array_key_exists($_key, $_array)) {
                return $_array[$_key];
            }
        }
        return $_default;
    }
}
