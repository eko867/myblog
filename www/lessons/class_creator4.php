<?php

abstract class HumanAbstract
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function getGreetings(): string;
    abstract public function getMyNameIs(): string;

    public function introduceYourself(): string
    {
        return $this->getGreetings() . '! ' . $this->getMyNameIs() . ' ' . $this->getName() . '.<br>';
    }
}

class RussianHuman extends HumanAbstract{
    public function getGreetings(): string
    {
        return 'Привет';
    }

    public function getMyNameIs(): string
    {
        return 'Меня зовут';
    }
}

class EnglishHuman extends HumanAbstract{
    public function getGreetings(): string
    {
        return 'Hello';
    }

    public function getMyNameIs(): string
    {
        return 'My name is';
    }
}

$h1=new RussianHuman('Иван');
$h2=new EnglishHuman('Ivan');
echo $h1->introduceYourself();
echo $h2->introduceYourself();



/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 14:19
 */