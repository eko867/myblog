<?php

//database handle
$dbh=new PDO(
    'mysql:host=localhost;dbname=users;',
    'root',
    ''
);

$dbh->exec("SET NAMES UTF8");

/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 09.08.2018
 * Time: 9:37
 */
?>

<html>
<head>
    <title>Join Us Newsletter</title>
    <style>
        *{font-family: Calibri}
    </style>
</head>
<body>
<?php
$email=filter_input(INPUT_POST,'user_email',FILTER_VALIDATE_EMAIL);
if ($email){
    //statement (or statement handle sth)
    //работаем по типу prepare-[bind]-execute
    // заранее скомпилированное SQL-выражение, которое может быть многократно выполнено путем отправки серверу лишь различных наборов данных
    //типа записал stm, забиндил, выполнил, изменил значения переменных, снова можно выполнить...

    //может быть с именными placeholders (принято обозначать с двоеточия, но работает и без них)
    $stm= $dbh->prepare('INSERT INTO newsletter(email) VALUES (:email)');
    $stm->bindValue('email',$email);

    //может быть с безымянным placeholders
    //$stm= $dbh->prepare('INSERT INTO newsletter(email) VALUES (?)');
    //$stm->bindValue(1,$email);

    //может быть без placholders (открывает дорогу инъекциям
    //$stm= $dbh->prepare('INSERT INTO newsletter(email) VALUES ($email)');


    $result= $stm->execute();

    if($result)
        echo '<p>Thank you</p>';
    else
        echo '<p>Something go wrong!!!</p>';

}
else
    echo '<p>Bad e-mail</p>';
?>
<h1> Подписка на новости сайта</h1>
<form action="subscribe.php" method="post">
    <input type="text" name="user_email" placeholder="mymail@mail.com" >
    <input type="submit">
</form>
</body>
</html>
