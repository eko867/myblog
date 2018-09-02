<?php
namespace Task3;
use Task3\FigureWithSquare; // по идее не нужен, т.к лежат в одной папке

class Circle extends FigureWithSquare
{
    private $radius;

    public function __construct(float $radius)
    {
        $this->radius=$radius;
    }

    public function getSquare():float
    {
        return M_PI*$this->radius**2;
    }

    public function setRadius(float $radius):void
    {
        $this->radius=$radius;
    }

    public function getRadius():float
    {
        return $this->radius;
    }
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 21.08.2018
 * Time: 17:28
 */