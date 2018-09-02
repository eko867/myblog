<?php
    if (!empty($_POST))
        //var_dump($_POST);
        //var_dump($_FILES);
###cookie over 4kb unsupported!!!!

        ##просто копируем текст из поля
        if (!empty($_POST['submit1'])) {
            $s = $_POST['textzone'] ?? '';
            setcookie('ar',$s,0,'/');
            setcookie('textzone',$s,0,'/');
        }
        #работаем с файлом
        else if (!empty(($_FILES['fileName1']['name']))) {
            //при чтении или записи надо сначала открыть файл и забрать содержимое
            if (!empty($_POST['submit2']) || !empty($_POST['submit3'])) {
                $path=$_FILES['fileName1']['tmp_name'];
                setcookie('path',$path,0,'/');
                $file = fopen($path, 'r');
                $string = '';
                while (!feof($file))
                    $string .= fgets($file) . '<br>';
                fclose($file);
                if (!empty($_POST['submit2'])) {
                    setcookie('ar', $string, 0, '/');
                    setcookie('textzone', '', -1, '/');
                }
                if (!empty($_POST['submit3'])) {
                    setcookie('ar', '', -1, '/');
                    setcookie('textzone', $string, 0, '/');
                }

            } //переносим из формы в "файл"
            else if (!empty($_POST['submit4'])) {
                file_put_contents($_COOKIE['path'], $_POST['textzone']);
                $file = fopen($_COOKIE['path'], 'r');
                $string = '';
                while (!feof($file))
                    $string .= fgets($file) . '<br>';
                fclose($file);
                setcookie('ar',$string,0,'/');
                setcookie('textzone',$string,0,'/');
            }

        }

header('Location:/index.php');

/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 05.08.2018
 * Time: 22:05
 */