<?php


namespace App\Models;


class Task extends \App\Engine\Model
{
    public const DATABASE_TABLE = 'tasks';
    public const COLUMN_PRIMARY = 'id';
    public const COLUMN_UPDATE_COLUMN = 'date_updating';
    public const COLUMN_INSERT_COLUMN = 'date_creating';
    public int $id;
    public int $status = 0;
    public string $name = '';
    public string $email = '';
    public string $content = '';
    public int $date_creating = 0;
    public int $date_updating = 0;

    public function setStatus(int $value): static
    {
        $this->status = $value;
        return $this;
    }

    public function setName(string $value): static
    {
        $this->name = $value;
        return $this;
    }

    public function setEmail(string $value): static
    {
        $this->email = $value;
        return $this;
    }

    public function setContent(string $value): static
    {
        $this->content = $value;
        return $this;
    }
}