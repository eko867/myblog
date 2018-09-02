<html>
<head>
    <title>Название страницы</title>
    <link rel="stylesheet" href="/styles.css">
<head>
<body>
<table class="oldTable" id="layout">
    <tr>
        <td colspan="2">HEADER<br>
            <?php
            echo $varHeader;
            ?><br>
            <a href="uploads.php">Загрузить в альбом</a>
            <br>

            <?php
            $uploadFolder='/uploads/';
            $arraySD=scandir(__DIR__.$uploadFolder);
            foreach ($arraySD as $item)
                if (!is_dir($item))
                    $links[]='http://qwer.loc:8080'.$uploadFolder.$item;
            foreach ($links as $link): ?>
            <a href="<?=$link ?>">
                <img src="<?=$link ?>" height="100px"><!--preview-->
            </a>
            <?php endforeach; ?>
        </td>
    </tr>
    <tr>

<?php
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 02.08.2018
 * Time: 21:53
 */