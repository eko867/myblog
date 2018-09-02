<?php

class Cat{
    private $name;
    private $color;
/*
    public function __construct(string $name=null, string $color=null){
        if (isset($name))
            $this->name=$name;
        if (isset($color))
            $this->color=$color;
    }
*/
/*
    public function __construct()
    {
        if (func_num_args()==2){
            $this->name=func_get_arg(0);
            $this->color=func_get_arg(1);
        }
        else if (func_num_args()==1)
            $this->name=func_get_arg(0);
    }
*/

    public function __construct(string $name, string $color){
            $this->name=$name;
            $this->color=$color;
    }

    public static function constructWithName(string $name):Cat{
        return new self($name,'noColor');
    }

    public static function constructWithColor(string $color):Cat{
        return new self('noName', $color);
    }

    public function setName(string $name){
        $this->name=$name;
    }

    public function setColor(string $color){
        $this->color=$color;
    }

    public function  getName() :string {
        return $this->name;
    }

    public function getColor() :string {
        return $this->color;
    }

    public function sayHello(){
        echo 'Hello, my name is '.$this->name.'.My color is '.$this->color;
        echo '<br>';
    }
}

$cat1=new Cat('Barsic', 'black');
$cat1->sayHello();
$cat1->setName('Boris');
$cat1->sayHello();

/*
$cat2=new Cat('M');
$cat2->sayHello();

$cat3=new Cat(null,'R');
$cat3->sayHello();
*/

$cat2=Cat::constructWithName('M');
$cat2->sayHello();

$cat3=Cat::constructWithColor('R');
$cat3->sayHello();

/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 10:51
 */