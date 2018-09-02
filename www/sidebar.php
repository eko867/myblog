<?php
require __DIR__.'/auth.php';
$login=getUserLoginFromCookie (); //returns login or NULL
?>

<td id="sidebar">SIDEBAR
    <?php
    echo $varSidebar.'<br>';
    ?>
    <?php if ($login==null) : ?>
    Авторизуйтесь<br>
    <form action="/loginpage.php" method="post">
        <label>
            Логин <input type="text" name="login">
        </label>
        <br>
        <label>
            Пароль <input type="password" name="password">
        </label>
        <br>
        <input type="submit" value="Войти">
    </form>
    <?php else :?>
    Добро пожаловать, <?= $login?>
    <a href="/logout.php">Logout</a>
    <?php endif;?>
</td>

<?php
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 02.08.2018
 * Time: 21:49
 */