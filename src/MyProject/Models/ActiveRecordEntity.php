<?php
namespace MyProject\Models;
use MyProject\Services\Db;

abstract class ActiveRecordEntity{
    protected $id; //int

    public function getId():int{
        return $this->id;
    }

    public function __set($string_with_smth,$value){
        $stringWithSmth=$this->underscoreToCamelCase($string_with_smth);
        //динамически создаем поле, название которое есть содержимое строки $stringWithSmth (camelCase), а значение берем из $value
        $this->$stringWithSmth=$value;
    }

    private function underscoreToCamelCase($string_with_smth):string {
        //например приводим строку со значением author_id к authorId
        $String_With_Smth=ucwords($string_with_smth, '_'); //делает первые буквы большими в словах, разделенных подчеркиванием
        $StringWithSmth=str_replace('_','',$String_With_Smth); //удаляем подчеркивания
        $stringWithSmth=lcfirst($StringWithSmth); //делаем первую букву маленькой
        return $stringWithSmth;
    }

    private function camelCaseToUnderscore($stringWithSmth):string {
        //(?<!pattern) отрицательное look-behind условие (это значит что у подходящей подстроки начало не должно совпадать с pattern)
        //(?<!^)[A-Z] ищем заглавные буквы, кроме заглавной буквы в начале исходной строки (т.к у нас camelCase)
        //плюс эти выдернутые заглавные буквы мы сможем забрать по $0 (лежат в нулевом элементе массива с результатами) и вставить перед ними _
        $string_With_Smth=preg_replace('/(?<!^)[A-Z]/', '_$0', $stringWithSmth);
        //опускаем регистр
        $string_with_smth=strtolower($string_With_Smth);
        return $string_with_smth;
    }

    abstract protected static function getTableName():string;

    public static function selectAll():array{
        $db=Db::getInstance();
        //$db=new Db(); //without SINGLETON Pattern
        //return $db->query('SELECT * FROM `articles;`',[],Article::class);
        //self подставит тот класс, в котором этот метод определен (у дочернего класса SuperArticle все равно подставится Article)
        //return $db->query('SELECT * FROM `articles;`',[],self::class);
        //static подставит тот класс, в котором у которого этот метод был вызван (позднее статическое связывание)((у дочернего класса SuperArticle теперь подставится SuperArticle)
        return $db->query('SELECT * FROM `'.static ::getTableName().'`;',[],static::class);
    }

    public static function selectById(int $id): ?self{
        $db=Db::getInstance();
        //$db=new Db(); //without SINGLETON Pattern
        //выгрузим сущности из таблицы
        $entities = $db->query(
            'SELECT * FROM `'.static::getTableName().'` WHERE `id`=:id ;' ,
            [':id'=> $id],
            static::class
            );
        return $entities ? $entities[0] : null; //if ($entities) return $entities[0]; else return null;
    }

    //метод рефлексивно читающий все свойства объекта и создающий массив: 'поле'=>'значение'
    private function mapPropertiesToDbFormat():array {
        $reflector=new \ReflectionObject($this);
        $objProperties=$reflector->getProperties();

        $mappedObjProperties=[];
        foreach ($objProperties as $objProperty){
            $camelCaseObjPropertyName=$objProperty->getName(); //например, вытащили свойство 'articleId'
            $underScoreObjPropertyName=$this->camelCaseToUnderscore($camelCaseObjPropertyName); //сделаем 'article_id'
            $mappedObjProperties[$underScoreObjPropertyName]=$this->$camelCaseObjPropertyName; //запищем в массив 'article_id'=>значение, записаное в объекте
        }

        return $mappedObjProperties;
    }

    //сохранение изменений (переносим значения полей объекта в запись таблицы БД)
    public function save():void{
        $mappedObjProperties=$this->mapPropertiesToDbFormat();
        //var_dump($mappedObjProperties);

        if ($this->id !== null)//если объект был создан для уже существующей записи, то id не нуль и будем делать UPDATE
            $this->update($mappedObjProperties);
        else //иначе объект создан для внесения новой записи в таблицы, делаем INSERT
            //$this->insert($mappedObjProperties);
            $this->insert1($mappedObjProperties);
    }

    private function update(array $mappedObjProperties):void{
        //можно и без `тильд`
        //UPDATE table_name SET column1 = :param1, column2 = :param2, ... WHERE condition;

        //сейчас у нас массив ['property1'=>value1, ...]
        //надо сделать 2 массива
        //первый массив-набор строк ['property1=:param1',...]
        //второй массив - ассоциативный [':param1'=>value,...]  //нужен для биндинга

        $propertyParamArray=[];
        $paramValueArray=[];
        $i=1;

        foreach ($mappedObjProperties as $property => $value){
            $propertyParamArray[]=$property.'=:param'.$i;
            $paramValueArray[':param'.$i]=$value;
            $i++;
        }

        //implode - массив строк склеивает в одну строку, вставляя разделитель
        $sql='UPDATE '.static::getTableName().' SET '.implode(',',$propertyParamArray).' WHERE id='.$this->id.';';
        //var_dump($sql);
        $dB=Db::getInstance(); //SINGLETON
        $dB->query($sql,$paramValueArray,static::class);
    }

    private function insert1(array $mappedObjProperties):void{
        //INSERT INTO table_name(column1,...) VALUES (:param1, ...);

        //id у нас автоинкремент, created_at - current timestamp => мх можно не кидать в запрос
        //для этого надо отфильтровать все null элементы массива
        $filteredObjProperties = array_filter($mappedObjProperties);


        //сейчас у нас массив ['property1'=>value1, ...]
        //надо сделать 2 массива
        //первый массив-набор строк ['property1',...]
        //второй массив-набор строк [':value1', ...]
        //третий массив - ассоциативный [':param1'=>value,...]  //нужен для биндинга

        $propertyArray=[];
        $paramArray=[];
        $paramValueArray=[];
        $i=1;

        foreach ($filteredObjProperties as $property => $value){
            $propertyArray[]=$property;
            $paramArray[]=':param'.$i;
            $paramValueArray[':param'.$i]=$value;
            $i++;
        }

        //implode - массив строк склеивает в одну строку, вставляя разделитель
        $sql='INSERT INTO '.static::getTableName().'('.implode(',',$propertyArray).') VALUES ('.implode(',',$paramArray).');';
        $dB=Db::getInstance(); //SINGLETON
        $dB->query($sql,$paramValueArray,static::class);

        //все новосозданные свойства(например, id, created_at) пропишем через refreshObj() внутри save()
        $this->id=$dB->getLastInsertId();
        $this->refreshObj();
    }

    private function insert(array $mappedObjProperties):void{
        //INSERT INTO table_name(column1,...) VALUES (:param1, ...);

        //сейчас у нас массив ['property1'=>value1, ...]
        //надо сделать 2 массива
        //первый массив-набор строк ['property1',...]
        //второй массив-набор строк [':value1', ...]
        //третий массив - ассоциативный [':param1'=>value,...]  //нужен для биндинга

        $propertyArray=[];
        $paramArray=[];
        $paramValueArray=[];
        $i=1;

        foreach ($mappedObjProperties as $property => $value){
            $propertyArray[]=$property;
            $paramArray[]=':param'.$i;
            $paramValueArray[':param'.$i]=$value;
            $i++;
        }

        //implode - массив строк склеивает в одну строку, вставляя разделитель
        $sql='INSERT INTO '.static::getTableName().'('.implode(',',$propertyArray).') VALUES ('.implode(',',$paramArray).');';
        //var_dump($sql);
        $dB=Db::getInstance(); //SINGLETON
        $dB->query($sql,$paramValueArray,static::class);

        //после помещения, хотим узнать id записи и занести ее в объект
        $temp=$dB->query('SELECT * FROM '.static ::getTableName().' ORDER BY id DESC LIMIT 1;',[],static::class);
        $this->id=$temp[0]->getId();
    }

    private function refreshObj():void{
        //после помещения в БД, хотим узнать id записи и обновить свойства объекта
        $this->id=Db::getInstance()->getLastInsertId();
        $objFromDb=static ::selectById($this->id);
        $reflector=new \ReflectionObject($objFromDb);
        $properties=$reflector->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objFromDb);
        }
    }

    public function delete():void{
        Db::getInstance()->query(
            'DELETE FROM '.static ::getTableName() .' WHERE id=:id;',
            [':id'=>$this->id]
        );
        $this->id=null; //объект ведь удален
    }



}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 16.08.2018
 * Time: 11:05
 */