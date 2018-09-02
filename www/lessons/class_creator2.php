<?php

class Post
{
    protected $title;
    protected $text;

    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }
}

class Lesson extends Post
{
    protected $homework;

    public function __construct(string $title, string $text, string $homework)
    {
        parent::__construct($title, $text);
        $this->homework = $homework;
    }

    public function getHomework(): string
    {
        return $this->homework;
    }

    public function setHomework(string $homework): void
    {
        $this->homework = $homework;
    }
}

class PaidLesson extends Lesson
{
    private $price;

    function __construct(string $title, string $text, string $homework, float $price)
    {
        parent::__construct($title, $text, $homework);
        $this->price=$price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getPrice():float {
        return $this->price;
    }


}

$pl=new PaidLesson('Lesson','Epta','Nothing',99.90);
var_dump($pl);
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 11:17
 */