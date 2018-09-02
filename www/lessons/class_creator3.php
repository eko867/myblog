<?php
require __DIR__ . '/class_creator.php';

interface CalcSquare{
    public function calcSquare():float ;
}

class Rectange implements CalcSquare{
    private $x;
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x=$x;
        $this->y=$y;
    }

    public function calcSquare():float
    {
        return $this->x*$this->y;
    }
}

class Square implements CalcSquare{
    private $x;

    public function __construct(float $x)
    {
        $this->x=$x;
    }

    public function calcSquare():float
    {
        return $this->x**2;
    }
}

class Circle implements CalcSquare{
    private $r;
    const PI=3.14;

    public function __construct(float $r)
    {
        $this->r=$r;
    }

    public function calcSquare():float
    {
        return self::PI*$this->r**2;
    }
}

$objects=[
    new Rectange(5,10),
    new Square(5),
    new Circle(5),
    new Cat('A','B')
];

foreach ($objects as $item ){
    if($item instanceof CalcSquare)
        echo 'Square of '.get_class($item).' = '.$item->calcSquare().'<br>';
    else
        echo 'Object of class '.get_class($item).' dont implements calcSquare()';
}


/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 12:58
 */