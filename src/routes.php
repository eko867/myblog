<?php
// ключи массива - регулярка, значения массива - новый масссив с названием класса контроллера и названием метода
return [
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye'],
    '~^articles/([0-9]+)$~' =>[\MyProject\Controllers\ArticlesController::class, 'postArticle'],
    '~^articles/([0-9]+)/edit$~' =>[\MyProject\Controllers\ArticlesController::class, 'editArticle'],
    '~^articles/([0-9]+)/delete$~' =>[\MyProject\Controllers\ArticlesController::class, 'deleteArticle'],
    '~^articles/add$~' =>[\MyProject\Controllers\ArticlesController::class, 'addArticle'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^(.*)$~'=>[\MyProject\Controllers\MainController::class, 'pageNotFound']
];

/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 22:25
 */