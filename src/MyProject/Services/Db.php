<?php
namespace MyProject\Services;

class Db{

    //private static $instancesCount=0; //кол-во созданных сущностей данного класса

    //теперь мы можем всегда иметь лишь один объект класса путем $db=Db::getInstance()
    //Потому что если объект класса Db создается впервые, то при вызове Db::getInstance() будет создан экземпляр класса и сохранен в статик переменной $instance
    //если объект уже имеется, то он лежит и в $instance, и мы его получим при вызове Db::getInstance()
    private static $instance;
    private $pdo; //PHP Data Object

    //делаем конструктор приватным, чтобы создать объект класса можно было лишь 1 раз и лишь через Db::getInstance()
    private function __construct()
    {
        //self::$instancesCount++;

        $db_settings=( require __DIR__.'/../settings_db_connection.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host='.$db_settings['host'].';dbname='.$db_settings['dbname'],
            $db_settings['user'],
            $db_settings['password']
        );

        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, array $params=[], string $className='stdClass'): ?array { //returns NULL or array
        //statement handle
        $sth=$this->pdo->prepare($sql); //returns PDOStatement
        $isResult=$sth->execute($params);

        if($isResult)
            //выгружаем результат в виде ORM(ObjectRelationModel), теперь объекты класса $className будут заполнены значениями
            //\PDO::FETCH_CLASS говорит о том, что нужно вернуть результат в виде объектов какого-то класса
            //'stdClass' стандартный класс php без свойств и методов (все необходимые поля создадутся на лету и будут public)
            return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
        else
            return null;
    }

    //public static function getInstancesCount():int{
    //    return self::$instancesCount;
    //}

    public static function getInstance():self { //возращает значение свойства $instance
        if (self::$instance===null) //Если оно равно null, будет создан новый объект класса Db, а затем помещён в это свойство
            self::$instance = new self();
        return self::$instance;
    }

    public function getLastInsertId():int{
        return (int)$this->pdo->lastInsertId();
    }

}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 15.08.2018
 * Time: 13:39
 */