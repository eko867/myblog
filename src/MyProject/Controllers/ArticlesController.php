<?php
namespace MyProject\Controllers;
//use MyProject\Services\Db;
use MyProject\Models\Users\User;
use MyProject\View\View;
use MyProject\Models\Articles\Article;

class ArticlesController{
    private $view; /** @var View */
    private $db; /** @var Db */

    public function __construct()
    {
        $this->view=new View(__DIR__.'/../../../templates');
        //$this->db=new Db();
    }

    //action
    public function postArticle(int $articleId){

        /* first verison with ORM but witout PDO
        $article=$this->db->query('SELECT * FROM `articles` WHERE `id`=:id;' , [':id' => $articleId]);
        $nickname=$this->db->query('SELECT `author_id` FROM `articles` WHERE `id`=:id;' , [':id' => $articleId]);

        if ($article==[]) {
            $this->view->renderHtml('/404.php', ['seek_page'=> 'articles/' . $articleId , 'title'=>'404'], 404);
            return; //for examle we returns at index.php to  $controller->$method(...$matches);
        } else
            $this->view->renderHtml('/articles/view.php',['article' => $article[0] ,'nickname' => $nickname[0], 'title'=>'Статьи']);
        */
        $article=Article::selectById($articleId);
        //$author=User::selectById($article->getAuthorId());
        if ($article==null) {
            $this->view->renderHtml('/404.php', ['seek_page'=> 'articles/' . $articleId , 'title'=>'404'], 404);
            return; //for examle we returns at index.php to  $controller->$method(...$matches);
        } else
            $this->view->renderHtml('/articles/view.php',['article' => $article, 'title'=>'Статьи']);

    }

    public function editArticle(int $articleId):void{
        $article=Article::selectById($articleId);
        if ($article===null) { //либо создаем новую статью
            $article=new Article();
            $article->setAuthorId(1); //пока что всегда автор - это user c id=1
            $article->setCreatedAt(date("Y-m-d H:i:s"));
            $article->setName('New author');
            $article->setText('New text');
            $article->save();
            $this->view->renderHtml('/newarticle.php', ['article' => $article, 'title' => 'creating new article']);
        }
        else { //либо редактируем старую
            $article->setName('New author');
            $article->setText('New text');
            $article->save();
        }

    }

    public function addArticle():void{
        $article=new Article();
        $article->setAuthor(User::selectById(1)); //пока что всегда автор - это user c id=1
        $article->setName('New author &&&&&&');
        $article->setText('New text ^^^^^^^');
        $article->save();
        //$article->setCreatedAtFromDb();  //можно id и время создания записать через refreshObj() внутри save()
        var_dump($article);
    }

    public function deleteArticle(int $articleId):void{
        $article=Article::selectById($articleId);
        if ($article!==null) {
            $article->delete();
            var_dump($article);
        }
        else{
            echo 'Удаление невозможно. Статья не найдена';
        }

    }

}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 15.08.2018
 * Time: 14:15
 */