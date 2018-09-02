<?php
namespace MyProject\Models\Articles;
use MyProject\Models\Users\User;
use MyProject\Services\Db;
use MyProject\Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
    protected $name; //string
    protected $text; //string
    protected $authorId; //string //в самой таблице в БД author_id
    protected $createdAt; //string //в самой таблице в БД created_at
    // //будем лечить попытки создания новых полей через магический метод _set($dinamicly_created_name, $value) (описан в родителе)

    public function getName():string {
        return $this->name;
    }

    public function getText():string {
        return $this->text;
    }

    public function setName(string $name):void{
        $this->name=$name;
    }

    public function setText(string $text):void{
        $this->text=$text;
    }

    public function setAuthorId(int $authorId):void{
        $this->authorId=$authorId;
    }

    public function setAuthor(User $user):void{
        $this->authorId=$user->getId();
    }

    public function setCreatedAt(string $time):void{
        $this->createdAt=$time;
    }

    public function setCreatedAtFromDb():void{
        $temp=Db::getInstance()->query('SELECT created_at FROM articles WHERE id='.$this->id.';',[],static::class);
        $this->createdAt=$temp[0]->getCreatedAt();
    }

    public function getCreatedAt():string{
        return $this->createdAt;
    }

    public function getAuthor():User{
        $u=User::selectById($this->authorId);
        return $u ? $u : new User();
    }

    public static function getTableName():string {
        return 'articles';
    }



}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 16:41
 */