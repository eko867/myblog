<?php
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
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 22.08.2018
 * Time: 21:50
 */