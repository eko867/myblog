<?php
namespace MyProject\Models\Users;
use MyProject\Models\ActiveRecordEntity;
class User extends ActiveRecordEntity
{
    protected $nickname; /** @var string */
    protected $email; /** @var string */
    protected $isConfirmed; /** @var int */
    protected $role; /** @var string */
    protected $passwordHash; /** @var string */
    protected $authToken; /** @var string */
    protected $createdAt; /** @var string */

    public function getNickname(): string{
        return !empty($this->nickname) ? $this->nickname : 'deleted user';
    }

    public static function getTableName():string {
        return 'users';
    }
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 14.08.2018
 * Time: 16:42
 */