<?php


namespace App\Models;


class User extends \App\Engine\Model
{
    public const DATABASE_TABLE = 'users';
    public const COLUMN_PRIMARY = 'id';
    public int $id;
    public string $username = '';
    public string $password = '';
    public string $session = '';

    public static function hashPassword(string $value): string
    {
        return hash('sha256', $value, true);
    }

    public function setSession(string $value): static
    {
        $this->session = $value;
        return $this;
    }
}