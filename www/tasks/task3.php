<?php
//т.к автолоада нету, подключаем вручную
require __DIR__ . '/../../src/Task3/FigureWithSquare.php';
require __DIR__ . '/../../src/Task3/Circle.php';
require __DIR__ . '/../../src/Task3/Rectangle.php';
require __DIR__ . '/../../src/Task3/Triangle.php';

//т.к наши классы сидят в неймспэйсе Task3
use Task3\Circle;
use Task3\Rectangle;
use Task3\Triangle;

$json='[{"type":"circle","radius":6},{"type":"rectangle","a":7,"b":5},{"type":"triangle","a":3,"b":5,"c":5},{"type":"rectangle","a":6.05,"b":8.03},{"type":"triangle","a":4,"b":5,"c":6},{"type":"circle","radius":3.91}]';
$arrayWithSquaresOfFigures=[];

$objects=json_decode($json);

foreach ($objects as $object) {
    $figure = null;
    switch ($object->type) {
        case 'rectangle':
            $figure = new Rectangle($object->a, $object->b);
            break;
        case 'circle':
            $figure = new Circle($object->radius);
            break;
        case 'triangle':
            $figure = new Triangle($object->a, $object->b,$object->c);
            break;
        default:
            echo 'Error';
    }
    $arrayWithSquaresOfFigures[(string)$figure->getSquare()] = $figure;
}
krsort($arrayWithSquaresOfFigures); //сортируем по ключу по убыванию
foreach ($arrayWithSquaresOfFigures as $square=> $figure)
    //get_class будет вместе с нейспейсом (для красоты можно написать свой метод в этих классах или через рефлексию)
    echo get_class($figure).' with square='.$square.'<br>';
//var_dump($arrayWithSquaresOfFigures);
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 22.08.2018
 * Time: 21:46
 */