<?php
namespace Task3;
use Task3\FigureWithSquare; // по идее не нужен, т.к лежат в одной папке

class Triangle extends FigureWithSquare
{
    private $a;
    private $b;
    private $c;

    public function __construct(float $a, float $b,float $c)
    {
        $this->a=$a;
        $this->b=$b;
        $this->c=$c;
    }

    public function getSquare():float
    {
        $p=($this->a+$this->b+$this->c)/2;
        return sqrt($p*($p-$this->a)*($p-$this->b)*($p-$this->c));
    }

    public function setA(float $a):void
    {
        $this->a=$a;
    }

    public function setB(float $b):void
    {
        $this->b=$b;
    }

    public function setC(float $c):void
    {
        $this->c=$c;
    }

    public function getA():float
    {
        return $this->a;
    }

    public function getB():float
    {
        return $this->b;
    }

    public function getC():float
    {
        return $this->c;
    }
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 21.08.2018
 * Time: 17:31
 */