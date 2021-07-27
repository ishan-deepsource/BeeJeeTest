<?php


namespace App\Engine;


class Model
{
    private array $previous = [];

    public const DATABASE_TABLE = '';
    public const COLUMN_PRIMARY = '';

    public function __construct()
    {
        $this->previous = $this->getCurrentValues();
    }

    private function getCurrentValues():array
    {
        $values = get_object_vars($this);

        unset(
            $values[self::COLUMN_PRIMARY],
            $values['previous'], $values['variables']
        );

        return $values;
    }

    public function insert():bool {
        $app   = Controller::$instance;
        $dbase = $app->db;
        $table = static::DATABASE_TABLE;
        $newer = $this->getCurrentValues();

        $columns = array(); $values = array();

        foreach ($this->getCurrentValues() as $column => $value) {
            $columns[] = "`{$column}`";
            $values[] = self::getExpr($value);
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', $values);

        $query = "INSERT INTO `{$table}` ({$columns}) VALUES ({$values})";

        if (!$query = $dbase->query($query)) return false;

        $this->previous = $newer;

        return true;
    }

    public function update():bool {
        $app   = Controller::$instance;
        $dbase = $app->db;
        $table = static::DATABASE_TABLE;
        $newer = $this->getCurrentValues();

        $primcol = static::COLUMN_PRIMARY;
        $primval = static::getExpr($this->$primcol);

        $query = array();

        foreach ($newer as $column => $value) {
            if ($value === $this->previous[$column]) continue;

            $value = self::getExpr($value);
            $query[] = "`{$column}` = {$value}";
        }

        $query = implode(', ', $query);
        $query = "UPDATE `{$table}` SET {$query} WHERE `{$primcol}` = {$primval} LIMIT 1";

        if ($dbase->query($query) and $dbase->getAffectedRows() === 0) return false;

        $this->previous = $newer;

        return true;
    }

    public function save():bool
    {
        $primcol = static::COLUMN_PRIMARY;
        return empty($this->$primcol) ? $this->insert() : $this->update();
    }

    public static function findAll(string $where = '', array $binds = [], array $order = [], int $limit = 0, int $offset = 0):array {
        $dbase = Controller::$instance->db;
        $table = static::DATABASE_TABLE;

        $sql = "SELECT * FROM `{$table}`";

        if ($where)
        {
            if ($binds)
            {
                $where = static::prepare($where, $binds);
            }

            $sql .= " WHERE {$where}";
        }

        if ($order)
        {
            $sql .= " ORDER BY ";
            foreach ($order as $column => $sort) {
                $sql .= "`{$column}` {$sort}, ";
            }
            $sql = substr($sql, 0, -2);
        }

        if ($limit > 0)
        {
            $sql .= " LIMIT {$limit}";
        }

        if ($offset > 0)
        {
            $sql .= " OFFSET {$offset}";
        }

        if ($query = $dbase->query($sql) and
            $query->num_rows > 0) {

            $objects = array();

            while ($obj = $query->fetch_object(static::class)) {
                $objects[] = $obj;
            }

            return $objects;
        }

        return [];
    }

    public static function findOne(string $where = '', array $binds = [], array $order = [], int $offset = 0):?static
    {
        $object = static::findAll($where, $binds, $order, 1, $offset);

        return empty($object) ? null : $object[0];
    }

    public static function number(string $where = '1'):int {
        $dbase = Controller::$instance->db;
        $table = static::DATABASE_TABLE;

        $sql = "SELECT COUNT(1) FROM `{$table}`";

        if ($where)
        {
            $sql .= " WHERE {$where}";
        }

        return (!$query = $dbase->query($sql) or $query->num_rows === 0) ? 0 : $query->fetch_row()[0];
    }

    private static function prepare(string $query, array $binds):string
    {
        $columns = array_keys($binds);
        $columns = array_map(fn($column) => ":{$column}", $columns);

        $values = array_values($binds);
        $values = array_map(fn($value) => self::getExpr($value), $values);

        return str_replace($columns, $values, $query);
    }

    private static function getExpr(mixed $value):mixed
    {
        $db = Controller::$instance->db;

        return match (gettype($value)) {
            'NULL'   => 'NULL',
            'string' => "'{$db->escape($value)}'",

            default  => $value
        };
    }
}