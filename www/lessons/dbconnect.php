<?php

//database handler based on PHP Data Object class
//dsn-data source name (driver of database)
$dbh=new PDO(
    'mysql:host=localhost;dbname=users;',
    'root',
    ''
);

$dbh->exec('SET NAMES UTF8');
//statement
$stm= $dbh->prepare('INSERT INTO data(`name`,`year`) VALUES (:name,:year)');
$stm->bindValue('name','Petya');
$stm->bindValue('year','1703');
$stm->execute();

//$stm= $dbh->prepare('SELECT * FROM `data`');
$stm= $dbh->prepare('SELECT * FROM `data` WHERE name=:name ');
$stm->bindValue('name','Petya');
$stm->execute();
//get results
$arrayUsers=$stm -> fetchAll();
/*
 * Created by PhpStorm.
 * User: drive867
 * Date: 09.08.2018
 * Time: 9:06
 */
?>
<html>
<head>
    <title>DB connect</title>
</head>
<body>
<table border="1">
    <tr>
        <td>Id</td><td>Name</td><td>Year</td>
    </tr>
    <?php
    foreach ($arrayUsers as $item)
        echo '<tr><td>'.$item['id'].'</td><td>'.$item['name'].'</td><td>'.$item['year'].'</td></tr>';
    ?>
</table>
</body>
</html>
