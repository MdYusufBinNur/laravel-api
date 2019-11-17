<?php


namespace App\Services;


class Point
{
    public $x;
    public $y;

    public function __construct($x = null, $y = null)
    {
        $this->x = is_numeric($x) ? floatval($x) : $x;
        $this->y = is_numeric($y) ? floatval($y) : $y;
    }
}
