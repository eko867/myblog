<?php
//есди авторизован, то отошлем еще логин
require __DIR__ . '/auth.php';
$login = getUserLoginFromCookie();

$result = null;
$text = $_POST['textFromUser'] ?? '';
$email = $_POST['emailFromUser'] ?? '';

if (!empty($text)) {
    $time = date(DATE_ATOM);
    //__DIR__ = C:\open_server_5_2_8_basic\OSPanel\domains\qwer.loc\www
    //нам надо C:\open_server_5_2_8_basic\OSPanel\domains\qwer.loc\ private/feedback.txt
    //для этого поднимемся в родит.каталог, сделав www/..
    if (file_put_contents(__DIR__ . '/../private/feedback.txt', $time . PHP_EOL . 'login = ' . $login . PHP_EOL . 'email = ' . $email . PHP_EOL . $text . PHP_EOL . PHP_EOL, FILE_APPEND))
        $result = 'Message sent';
    else
        $result = 'Error. Try send again.';
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 06.08.2018
 * Time: 16:38
 */
?>

<html>
<head>
    <title>Feedback form</title>
</head>
<body>
<a href="/index.php">На главную</a>
<div style="text-align: center">
    <h3>Форма обратной связи</h3>
    <div>
        <?php if ($result != null): ?>
            <b><?= $result ?></b>
        <?php endif; ?>
    </div>
    <form action="feedback.php" method="post">
        <label for="text">Введите ваше обращение:</label>
        <br>
        <textarea name="textFromUser" id="text" cols="60" rows="20"></textarea>
        <br>
        <label for="email">Почта для связи:</label>
        <br>
        <textarea name="emailFromUser" id="email" cols="40" rows="1"></textarea>
        <br>
        <input type="submit" value="send">
    </form>
</div>
</body>
</html>
