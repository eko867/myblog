<?php
//тренируем работу с массивами

//while (true) // for (;;) {
//    echo '1'.'<br>';

$fruits = []; //empty array
$fruits = ['apple', 'banan', 'qiwi']; //initialize
$fruits[] = 'mango'; //add to end
$fruits[5] = 'heh'; //можно вставить не по порядку $fruits[4]-пустой (дырка)
$lenght=count($fruits);

var_dump($fruits);

unset($fruits[2], $fruits[3]); //deleting elements
var_dump($fruits);

$fruits1 = [5 => 'apple', 3 => 'orange', 9 => 'grape']; //задание с произвольными индексами

$article = ['title' => 'Название статьи', 'text' => 'Текст статьи']; //ассоциативный массив (как map)
$article['author'] = 'Имя автора';

//многомерные массивы
$debts = [
    'Alex' => [
        'med' => 300,
        'bank' => 1000,
        'food' => 200
    ],
    'Toni' => [
        'med' => 100,
        'bank' => 400,
        'food' => 140
    ]
];

var_dump($debts);

$debts['Mike'] = [
    'med' => 320,
    'bank' => 160,
    'food' => 20
];

$debts['Alex']['food'] = 10000;
var_dump($debts);


$arr = [0 => [
        0 => 0,
        1 => 1,
        2 => 2
],
    1 => [
        0 => 3,
        1 => 4,
        2 => 5
    ]
];
var_dump($arr);

//цикл foreach (пишем для какого массива, цепляемся за его индексы и значения и делаем какое-то действие на каждой итерации
foreach ($article as $ind =>$val) {
    echo $ind.' '.$val.'<br>';
}

$evenArr=[];
$i=346;
while($i<357){
    $evenArr[]=$i;
    $i+=2;
}
foreach ($evenArr as $ind=>$val)
    echo $ind.' '.$val.'<br>';

############
function isNumberInArr($x, array $arr){
    //for($i=0; $i<count($arr); $i++ )
    //if ($arr[$i]===$x) //fullequivalent
    foreach($arr as $elem)
        if($elem===$x)
            return true;
    return false;
}

echo (int)isNumberInArr('apple', $fruits).'<br>';

################
function numElemAsX($x, array $arr){
    $num=0;
    foreach($arr as $elem)
        if($elem===$x)
            $num++;
    return $num;
}

echo numElemAsX(2,[2,4,5,2,2,1,2]).'<br>';

#############
$arr=array_fill(0,10,0);
$str='';
foreach ($arr as $ind=>$val)
    $arr[$ind] = rand(0, 100);
print_r($arr);

sort($arr);
echo '<br>'.implode('::',$arr);

###################
//for($i=1; $i<10; $i++)

#$i=1;
#for( ; $i<10; $i++)

#for($i=1; $i<10; )
# $i++
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 03.08.2018
 * Time: 10:41
 */