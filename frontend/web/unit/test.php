<?php

include_once 'calculator.php';

class test
{
    public function __construct()
    {
        self::testAddCorrect();
    }

    public function testAddCorrect()
    {
        echo 'Running '.__METHOD__.'<hr>';

        $result = calculator::add(1,6);
        if ($result === 15)
        {
            echo 'passed';
        } else
        {
            echo 'Failed expected (integer) 15. Result is ('.gettype($result).') '.$result;
        }

    }
}
new test();