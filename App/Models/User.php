<?php


namespace App\Models;


class User extends \App\Engine\Model
{
    public int      $id;
    public string   $username = '';
    public string   $password = '';
    public string   $session = '';

    public const DATABASE_TABLE = 'users';
    public const COLUMN_PRIMARY = 'id';

    public function setSession(string $value):static
    {
        $this->session = $value; return $this;
    }

    public static function hashPassword(string $value):string
    {
        return hash('sha256', $value, true);
    }
}