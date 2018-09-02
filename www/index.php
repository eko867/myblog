<?php

//this text was added on GitHub

//============АВТОЗАГРУЗКА КЛАССОВ (классы должны лежать в папке src)
//действует только на index.php
//когда в коде будет встречаться класс, который ещё не был подключён, то автоматом вызывается spl_autoload
//в функцию передается переменная, содержащая полное имя класса ($className=namespase/имя_класса)
//так что надо вешать неймспейсы (+не забывать потом use в тех файлах, где используешь эти классы)

//spl_autoload_register регистрирует в качестве автозагрузки анонимную функцию
spl_autoload_register(
    function (string  $className):void
    {
        require_once __DIR__ . '/..' . '/src/' . $className . '.php';
    }
);
//===================================================

//====================================TASKS FOR ET=====================================
/*
//========Task3===========
//also visit qwer.loc:8080/task3.php
//по правилам use, надо вешать в начало страницы
//use нужны, т.к классы лежат в другой папки и мы их вынесли в неймспейс Task3
use Task3\Circle;
use Task3\Rectangle;
use Task3\Triangle;

/*теперь не нужны, т.к классы лежат в src + есть неймспейс + автолоад
require __DIR__ . '/FigureWithSquare.php';
require __DIR__ . '/Circle.php';
require __DIR__ . '/Rectangle.php';
require __DIR__ . '/Triangle.php';


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


//========Task2===========
//also visit qwer.loc:8080/task2.php
use Task2\Db; //по правилам, надо вешать в начало страницы

$sql='SELECT `authors`.`author_name` FROM `authors` WHERE (
      SELECT COUNT(`links`.`author_id`) FROM `links` 
      WHERE `links`.`author_id`=`authors`.`author_id` ) < :max_books;';

$max_books=4;

$authors=Db::getInstance()->query($sql,[':max_books'=>$max_books]);
//var_dump($authors);
foreach ($authors as $author) {
    echo $author['author_name'] . '<br>';
}

//========Task1===========
//also visit qwer.loc:8080/task1.php
function isPrime(int $num):bool
{
    if ($num==1)
        return false;
    elseif ($num==2)
        return true;

    for ($i=2; $i<=(int)sqrt($num); $i++) //возможные делители числа ищем среди в интервале от 2 до sqrt(N)
        if ($num % $i == 0) //если у числа обнаружен делитель, значит оно не простое
            return false;
    return true;
}//работает долго

function getArrayOfPrimeNums(int $upperBound):array
{
    // в массиве $candidates[$num] отмечаем:
    // false, если число $num не простое
    // остальные числа в массиве не установлены (т.е. null) для экономии памяти (будут стрелять предупреждения)
    $candidates = ['1' => false];

    // выполняем решето Эратосфена, причем делители числа лежат от 2 до sqrt($upperBound)
    for ($num = 2; $num <= (int)sqrt($upperBound); $num++) {
        if ($candidates[$num] === false)
            continue; //число уже выколото, просто продолжаем
        else
            for ($j = 2 * $num; $j <= $upperBound; $j+=$num)
                $candidates[$j] = false; // составные числа на базе нашего простого выкалываем
    }

    $arrayOfPrimeNums = [];

    for ($num=2; $num<=$upperBound; $num++)
        if ($candidates[$num]!==false) //элементы, которые null и являются простыми числами
            $arrayOfPrimeNums[] = $num;

    return $arrayOfPrimeNums;
}

$upperBound=100;
$primeNums=getArrayOfPrimeNums($upperBound);
//var_dump($primeNums);
$sumOfPrimeNums=0;
foreach ($primeNums as $primeNum)
    $sumOfPrimeNums+=$primeNum;

echo $sumOfPrimeNums;

$s=0;
for ($i=0; $i<=$upperBound; $i++)
    $s+=$i;
echo '<br>'.$s;
//===================================END TASKS FOR ET===============
*/

//==================ROUTING===========================
//ROUTING ZERO VERSION (запрашиваем страницу через гет запрос qwel.loc:8080/index.php?name=... -> дальше читаем _GET и грузим)
/*
$controller=new \MyProject\Controllers\MainController();
if (!empty($_GET['name']))
    $controller->sayHello($_GET['name']);
else
    $controller->main();
*/

//ROUTING FIRST VERSION (только на hello и главную)
/*
//(делаем ЧПУ qwer.loc:8080/hello/username)
preg_match('~^hello/(?P<username>.*)$~',$route,$matches);
if (!empty($matches)){
    $controller=new MyProject\Controllers\MainController();
    $controller->sayHello($matches['username']);
    //return; //вернуться в контроллер
}
//(делаем ЧПУ qwer.loc:8080/ )
preg_match('~^$~',$route,$matches);
if (!empty($matches)){
    $controller=new MyProject\Controllers\MainController();
    $controller->main();
    //return;
}
else
    echo 'Page not found';
*/

//ROUTING SECOND VERSION (ЧПУ-человекопонятные урээлы + РВ + MVC)
$route=$_GET['route'] ?? ''; //returns from .htaccess
$routingRules=require __DIR__.'/../'.'src/routes.php'; //получаем массив из return

$isRouteFound=false;
foreach ($routingRules as $pattern => $controllerAndMethod) {//$array as $index => $value
    preg_match($pattern,$route,$matches);
    if (!empty($matches)){
        $isRouteFound=true;
        break;
    }
}
// неактуально, сделали страницу 404
//if (!$isRouteFound) {
//   echo 'Page not found';
//    return;
//}

$controllerName = $controllerAndMethod[0];
$controller=new $controllerName;//охренеть как можно создать объект класса!

$method=$controllerAndMethod[1];
unset($matches[0]); //удаляем нулевой элемент массива, т.к это и есть сам путь, а нам нужен следующий элемент (масочный) где сидит нужная часть адреса
$controller->$method(...$matches); //и также охренительно вызывать его метод //троеточие позволяет передать аргументы в виде массива
//============END OF ROUTING===================

//Делали для разбора SIngleton паттерна
//var_dump(\MyProject\Services\Db::getInstancesCount());

//первые пробы пера с классами
/*
$author=new \MyProject\Models\Users\User('Author1');
$article=new \MyProject\Models\Articles\Article('Title1', 'Text1', $author);
var_dump($author);
var_dump($article);
*/

//===============ВЫВОДИМ СОДЕРЖИМОЕ СТРАНИЦЫ======================
//DIR - магическая переменная, т.к ее значение зависит от того, где лежит сам файл с кодом
//например для index.php - это C:\open_server_5_2_8_basic\OSPanel\domains\qwer.loc\www\
//поэтому после DIR надо выстраивать путь вручную, чтобы добраться до папки с нужным файлом (или ничего не делать, если все в этой же папке)
$varHeader='Hello in header';
$varSidebar='Ads is here';
$varContent='My CALCULATOR';
$varFooter='Bye in footer';

require __DIR__.'/header.php';
require __DIR__.'/sidebar.php';
$var1=require __DIR__.'/content.php';
$var2=require __DIR__.'/footer.php';

echo $var1.' '.$var2.'<br>';
//============================================================

//ПЕРВЫЕ ПРОСТЕЦКИЕ ФУНКЦИИ и первые шаги
/*
function minOfFloats(float $a, float $b, float $c){
    if($a<$b && $a<$c)
        return $a;
    if($b<$a && $b<$c)
        return $b;
    return $c;
}

function multX2(&$a, &$b){
    $a*=2;
    $b*=2;
}

function fact(int $a){
    if ($a<=1)
        return 1;
    return $a*fact($a-1);
}

function numPrinter(int $a){
    if ($a>0)
        numPrinter($a-1);
    echo $a.'<br>';
}

//phpinfo();
//echo minOfFloats(10,0.2,-30.25);

#$a=1; $b=2.4; multX2($a, $b);
#echo $a.' '.$b;

//echo fact(10);

#numPrinter(100);

/*echo 'xx';
$x=5+2;
$x*=2;
$x+=2;

echo __DIR__;
*/

//=========Читаем файл с кодом нашей страницы и печатаем его содержимое
/*
echo '<br><br><br><br>'.'Source code of this page'.'<br>';
$file=fopen(__DIR__.'/index.php','r'); // или скрытое имя _FILE_
while (!feof($file))
echo fgets($file).'<br>'; //построчное чтение
fclose($file);

//echo file_get_contents(__DIR__.'/index.php'); //читаем файл целиком (но переносы видны лишь в хтмл коде)
*/

//====сканируем директории на наличие папок и файлов
/*
echo '<br><br><br>';
$arrayDirs=scandir(__DIR__);
foreach ($arrayDirs as $item)
    if (is_dir($item))
        echo $item.' ------- dir<br>';
    else
        echo $item.'------- file <br>';
*/
