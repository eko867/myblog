<?php
namespace MyProject\View;

class View{
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath=$templatesPath; //путь до папки с шаблонами (C:\open_server_5_2_8_basic\OSPanel\domains\qwer.loc\templates )
    }

    public function renderHtml(string $templateName, array $vars=[], int $code=200){

        http_response_code($code); //code -код ответа пссле загрузки страницы (200-все ок, 404 - notFound)

        //получаем переменные
        extract($vars); //if was array ['key1']=1 ['key2']=2, become $key1=1, $key2=2

        ob_start(); //запукскаем временный буфер вывода, чтобы все выходные результаты работы скрипта теперь накалпиваются в буфере (кроме заголовков)
        //т.е весь хтмл+эхо код (которые мы получим из include) будет буферизован (а-ля помещается в буфер в виде строки)
        include $this->templatesPath.'/'.$templateName; //получаем путь до конкретного шаблона
        $buffer=ob_get_contents(); // выгружаем содержимое буфера в переменную $buffer
        //(через исключения их можно обработать их на ошибки в процессе отрисовки шаблона)
        ob_end_clean(); //отключает буфер+очищает его  //ob_flush() просто очищает
        //отобразим ранее буферизованные данные
        //(!!! работает только после ob_end_clean !!!) (потому что если сделать до отключения буфера, то echo угодит в буфер, а не на вывод)
        echo $buffer;
    }
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 15.08.2018
 * Time: 10:34
 */