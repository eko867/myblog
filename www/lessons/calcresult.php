<?php
$result=require __DIR__ . '/calc.php';

/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 04.08.2018
 * Time: 11:20
 */
?>

<html>
<head>
    <title>Calculation result</title>
</head>
<body>
    <b>Результат</b>
    <br>
    <?= $result ?>
</body>
</html>
