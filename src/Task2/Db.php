<?php
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 21.08.2018
 * Time: 15:31
 */
namespace Task2;
class Db
{
//создадим класс подключения к БД по паттерну Singleton
//гарантируется что в рамках программы будет только один объект класса, располагающийся в $instance
    private static $instance;
    private $pdo; //PHP Data Object

    private function __construct()
    {
        $db_settings = require __DIR__ . '/settings_db_connection.php';

        $this->pdo = new \PDO(
            'mysql:host=' . $db_settings['host'],
            $db_settings['user'],
            $db_settings['password']
        );

        $this->pdo->exec('CREATE DATABASE IF NOT EXISTS `' . $db_settings['dbname'] . '`;');

        $this->pdo->exec('USE `' . $db_settings['dbname'] . '`;');

        $this->pdo->exec('SET NAMES UTF8');

        $this->pdo->exec('CREATE TABLE IF NOT EXISTS `books` (
            `book_id` INT NOT NULL AUTO_INCREMENT ,
            `book_name` VARCHAR(255) NOT NULL ,
            PRIMARY KEY (`book_id`)) CHARSET=utf8 COLLATE utf8_unicode_ci;');

        $this->pdo->exec('CREATE TABLE IF NOT EXISTS `authors` (
            `author_id` INT NOT NULL AUTO_INCREMENT ,
            `author_name` VARCHAR(255) NOT NULL ,
            PRIMARY KEY (`author_id`)) CHARSET=utf8 COLLATE utf8_unicode_ci;');

        $this->pdo->exec('CREATE TABLE IF NOT EXISTS `links` (
            `link_id` INT NOT NULL AUTO_INCREMENT ,
            `book_id` INT NOT NULL ,
            `author_id` INT NOT NULL ,
            PRIMARY KEY (`link_id`),
            FOREIGN KEY (`book_id`) REFERENCES `books`(`book_id`)
              ON UPDATE CASCADE
              ON DELETE RESTRICT ,
            FOREIGN KEY (`author_id`) REFERENCES `authors`(`author_id`)
              ON UPDATE CASCADE 
              ON DELETE RESTRICT )
            CHARSET=utf8 COLLATE utf8_unicode_ci;');
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = []): ?array
    {
        //statement handle (object of PDOStatement)
        $sth = $this->pdo->prepare($sql);
        $isResult = $sth->execute($params);

        if ($isResult) {
            return $sth->fetchAll();
        }
        return null;
    }
}
