<?php

namespace MyProject\Controllers;

use MyProject\View\View;
//use MyProject\Services\Db;
use MyProject\Models\Articles\Article;

class MainController{

    private $view; //объект класса View
    private $db; //объект класса Db

    public function __construct()
    {
        //for this file _DIR_ is  C:\open_server_5_2_8_basic\OSPanel\domains\qwer.loc\src\MyProject\Controllers\
        $this->view = new View(__DIR__.'/../../../templates');

        //c переходом на ORM ActiveRecord контроллер не должен заниматься работой с БД,
        // этим займутся сами объекты (за счет статических CRUD операций)
        //$this->db=new Db();
    }

    //это action при работе на главной
    public function main(){
        //echo 'Main page';

        /* version without Db
        $articles=[
            ['name'=>'article1', 'text'=>'text of article1'],
            ['name'=>'article2', 'text'=>'text of article2']
        ];
        */

        //$articles=$this->db->query('SELECT * FROM `articles`',[],Article::class);
        //раньше было: $articles массив, каждый жлемент это массив с полями от строки из таблицы БД
        //сейчас с ORM стало: $articles массив объектов класса Article, где каждый объект по полям эквивалентен строке из таблицы БД

        //совсем cейчас статьи выгружаем через статический метод, чтобы контроллер этим не занимался
        $articles=Article::selectAll();
        $this->view->renderHtml('/main/main.php', ['articles' => $articles]);

        /*чтобы убрать все эти инклюды пссле каждого View,
        //мы написали класс View, где с пом.функции renderHtml будем подгружать файлы с шаблонами и закидывать туда переменные
        //for this file _DIR_ is  C:\open_server_5_2_8_basic\OSPanel\domains\qwer.loc\src\MyProject\Controllers\
        include __DIR__.'/../../../templates/main/main.php';
        */
    }

    //это action при переходе на /hello/...
    public function sayHello(string $name):void {
        $this->view->renderHtml('main/hello.php',['name' => $name, 'title'=>'Страница приветствия']);
    }

    //это action при переходе на /bye/...
    public function sayBye(string $name):void{
        $this->view->renderHtml('main/bye.php',['name'=> $name, 'title'=>'Страница прощания']);
    }

    //это action кидаеет на /404
    public function pageNotFound(string $seek_page){
        $this->view->renderHtml('404.php',['seek_page'=> $seek_page, 'title'=>'Error 404'], 404);
    }
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 19:14
 */