<?php
//task 2 for Efficient Technology
require_once __DIR__ . '/../../src/Task2/Db.php';
use Task2\Db;

$sql='SELECT `authors`.`author_name` FROM `authors` WHERE (
      SELECT COUNT(`links`.`author_id`) FROM `links` 
      WHERE `links`.`author_id`=`authors`.`author_id` ) < :max_books;';

$max_books=3;

$authors=Db::getInstance()->query($sql,[':max_books'=>$max_books]);
foreach ($authors as $author) {
    echo $author['author_name'] . '<br>';
}

/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 21.08.2018
 * Time: 15:23
 */