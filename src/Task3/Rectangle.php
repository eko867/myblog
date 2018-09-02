<?php
namespace Task3;
use Task3\FigureWithSquare; // по идее не нужен, т.к лежат в одной папке

class Rectangle extends FigureWithSquare
{
    private $a;
    private $b;

    public function __construct(float $a, float $b)
    {
        $this->a=$a;
        $this->b=$b;
    }

    public function getSquare():float
    {
        return $this->a*$this->b;
    }

    public function setA(float $a):void
    {
        $this->a=$a;
    }

    public function setB(float $b):void
    {
        $this->b=$b;
    }

    public function getA():float
    {
        return $this->a;
    }

    public function getB():float
    {
        return $this->b;
    }
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 21.08.2018
 * Time: 17:19
 */