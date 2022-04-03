<?php


namespace App\Helpers;


class Math
{
    public static function rand_float($start = 0,$end = 1,$mul = 1000000)
    {
        if ($start > $end) return false;
        return number_format(mt_rand($start * $mul, $end * $mul)/$mul, 2);
    }

    public static function rand_int($start = 0,$end = 1,$mul = 1000000)
    {
        if ($start > $end) return false;
        try {
            return random_int($start, $end);
        } catch (\Exception $e) {
            // Here we should implement our own exceptions that have their own dependencies for ConsoleOutput
            // but for this demo decided not to implement exceptions
            die($e->getMessage());
        }
    }
}