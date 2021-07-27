<?php


namespace App\Engine\Database;

use mysqli;
use mysqli_result;

class Mysql
{
    public ?mysqli $mysqli = null;

    public function __construct(
        public string $address,
        public string $username,
        public string $password,
        public string $database,
        public string $charset = 'utf8'
    ) {}

    public function connect():void
    {
        $connection = mysqli_connect(
            $this->address,
            $this->username,
            $this->password,
            $this->database
        );

        if (!$connection)
        {
            throw new \Exception('Cant connect to database!');
        }

        if (!$connection->set_charset($this->charset))
        {
            throw new \Exception('Cant set charset for database!');
        }

        $this->mysqli = $connection;
    }

    public function getAffectedRows():int {
        return $this->mysqli ? $this->mysqli->affected_rows : 0;
    }

    public function getInsertId():int|string {
        return $this->mysqli ? $this->mysqli->insert_id : 0;
    }

    public function beginTransaction(int $flags = 0):bool {
        if (!$this->mysqli) $this->connect();
        return $this->mysqli->begin_transaction($flags);
    }

    public function commit(int $flags = 0):bool {
        if (!$this->mysqli) $this->connect();
        return $this->mysqli->commit($flags);
    }

    public function rollback(int $flags = 0):bool {
        if (!$this->mysqli) $this->connect();
        return $this->mysqli->rollback($flags);
    }

    public function query(string $query):bool|mysqli_result {
        if (!$this->mysqli) $this->connect();
        return $this->mysqli->query($query);
    }

    public function escape(string $string):string {
        if (!$this->mysqli) $this->connect();
        return $this->mysqli->real_escape_string($string);
    }
}