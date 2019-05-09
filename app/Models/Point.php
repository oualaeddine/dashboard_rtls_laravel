<?php
namespace App\Models;

class Point
{
     public $x;
    public $y;
    public $d;

    public function __construct($x, $y, $d)
    {
        $this->x = $x;
        $this->y = $y;
        $this->d = $d;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getD()
    {
        return $this->d;
    }
}

?>
