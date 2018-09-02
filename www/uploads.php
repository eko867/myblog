<?php
$uploadFolder = '/uploads/';
//var_dump($_FILES);

//авторизован ли пользователь
require __DIR__ . '/auth.php';
$login = getUserLoginFromCookie();

if ($login !== null && !empty($_FILES['fname'])) {
    $tmpFile = $_FILES['fname'];
    $error = '';

#загрузился ли временный файл
    if ($tmpFile['error'] != UPLOAD_ERR_OK)
        $error .= 'tempfile upload error' . '<br>';
#строим путь для перемещения временного файла в хранилище
    $tmpFileName = $tmpFile['name'];
    $tmpFilePath = $tmpFile['tmp_name'];
    $newFilePath = __DIR__ . $uploadFolder . $tmpFileName;
    $allowedExtensions = ['txt', 'jpg', 'png'];
    $imageExtensions = ['jpg', 'png'];
    $tmpFileExtension = pathinfo($tmpFileName, PATHINFO_EXTENSION);
#нет ли в хранилище файла с таким же именем
    if (file_exists($newFilePath))
        $error .= 'File name already exists in upload folder' . '<br>';
#безопасное ли у файла расширение
    if (!in_array($tmpFileExtension, $allowedExtensions))
        $error .= 'Запрщененое расширение файла' . '<br>';
//не превышен ли размер файла 2mb=2*1024*1024b
    if ($tmpFile['size'] > 2*1048576)
        $error .= 'File over 2MB' . '<br>';
//не превышен ли upload_max_filesize из php.ini
    if ($tmpFile['error'] == UPLOAD_ERR_INI_SIZE)
        $error .= 'Exceed upload_max_filesize' . '<br>';
//если изображение, то разрешение не более 1024*768
    if (in_array($tmpFileExtension, $imageExtensions))
        if (getimagesize($tmpFilePath)[0] > 2048|| getimagesize($tmpFilePath)[1] > 1560)
            $error .= 'Image exceed 2048*1560' . '<br>';
#переносим в хранилище
    if (empty($error))
        if (!move_uploaded_file($tmpFilePath, $newFilePath))
            $error .= 'Move upload error' . '<br>';
#если все прошло ок
    if (empty($error))
        $result = 'Файл загружен в ' . $newFilePath;
}

/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 06.08.2018
 * Time: 12:29
 */
?>

<html>
<head>
    <title>Upload file on server</title>
</head>
<body>
<a href="/index.php">Главная</a>
<br>
<?php
if ($login === null): ?>
    <a href="/loginpage.php">Авторизация</a>
    <br>
<? else: ?>
    Добро пожаловать,<?= $login ?><br>
    <a href="/logout.php">Exit</a>
    <br>
    <?php
    if (!empty($error))
        echo $error;
    else if (!empty($result))
        echo $result;
    ?>
    <form action="uploads.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fname">
        <br>
        <input type="submit" value="upload">
    </form>
<?php endif; ?>
</body>
</html>
