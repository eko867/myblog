<?php
function checkAuth(string $login, string $password):bool{
    $userDB=require __DIR__.'/userDB.php';

    foreach ($userDB as $item){
        if ($item['login']===$login && $item['password']===$password)
            return true;
    }
    return false;
}

function getUserLoginFromCookie (): ?string { #may be returned NULL or string(if User was authorized)
    $loginInCookie=$_COOKIE['login'] ?? '';
    $passwordInCookie=$_COOKIE['password'] ?? '';

    if(checkAuth($loginInCookie, $passwordInCookie))
        return $loginInCookie;
    else
        return null;
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 05.08.2018
 * Time: 17:13
 */