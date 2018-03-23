<?php

/**
 * Created by PhpStorm.
 * User: Kirilloid
 * Date: 23.03.2018
 * Time: 20:06
 */
class calculator
{
    public static function add($a, $b)
    {
        return $a + $b;
    }

    public static function divide($a, $b)
    {
        if ($b == 0)
        {
            return null;
        }
        return $a/$b;
    }
}