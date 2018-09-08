<?php
require __DIR__.'/auth.php';

if (getUserLoginFromCookie()!=null)
    header('Location: /index.php'); //redirect
if(!empty($_POST)){
    $login = !empty($_POST['login'])    ?   $_POST['login'] : '' ; //$login = $_POST['login'] ?? '';
    // ?? - coalescing operator (говорит, что делать, если переменная не была установлена (т.е. NULL)
    $password = !empty($_POST['password'])   ?   $_POST['password'] : ''; // $password=$_POST['password'] ?? '';

    if(checkAuth($login,$password)){
    setcookie('login',$login,0,'/');
    setcookie('password',$password,0,'/');
    header('Location: /index.php'); //redirect
    }
    else
        $error='Auth error';
}
?>

<html>
<head>
    <title>Вход</title>
</head>
<body>
<?php if(isset($error)) :?>
<span style="color: red"><?= $error ?></span>
<?php endif;?>
<form action="/loginpage.php" method="POST">
    <label for="login">Login:</label><input type="text" name="login" id="login">
    <br>
    <label for="password">Password:</label><input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Go">
</form>
</body>
</html>

<?php
/*
if (strcmp($login, 'admin') != 0)
    $isLogin = false;
else {
    $isLogin = true;
    if (strcmp($password, 'pwd') == 0)
        $isPassword = true;
    else
        $isPassword = false;
}

if ($isLogin && $isPassword) {
    setcookie('login', $login, 0, '/');
    setcookie('password', $password, time()+30, '/');
    echo 'cookies were set';
}

?>
*/

/*
<html>
<head>
    <title>Результат авторизации</title>
</head>
<body>
<p>
    <?php
    if ($isLogin)
        if ($isPassword)
            echo 'You are log in';
        else
            echo 'Wrong password';
    else
        echo 'User not found';
    ?>


</p>
</body>
</html>
*/
