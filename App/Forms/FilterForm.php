<?php


namespace App\Forms;


use App\Engine\Html\Input\Select;

class FilterForm extends \App\Engine\Html\Form
{
    public function __construct()
    {
        $this->order = new Select([
            'title' => 'Поле',
            'options' => [
                'id' => 'По ID',
                'status' => 'По статусу',
                'name' => 'По имени',
                'email' => 'По Email'
            ],
            'value' => 'id'
        ]);

        $this->sort = new Select([
            'title' => 'Сортировка',
            'options' => [
                'ASC' => 'По возрастанию',
                'DESC' => 'По убыванию'
            ],
            'value' => 'DESC'
        ]);
    }
}