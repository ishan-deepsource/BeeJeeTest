<?php


namespace App\Forms\Tasks;


use App\Engine\Html\Input\Email;
use App\Engine\Html\Input\Select;
use App\Engine\Html\Input\Text;
use App\Engine\Html\Input\Textarea;
use App\Models\Task;

class ComposeForm extends \App\Engine\Html\Form
{
    public function __construct(?Task $task = null)
    {
        $this->name = new Text([
            'title' => 'Имя',
            'minlength' => 4,
            'maxlength' => 20,
            'value' => $task?->name
        ]);

        $this->status = new Select([
            'title' => 'Статус',
            'options' => [
                0 => 'Не выполнено',
                1 => 'Выполнено'
            ],
            'value' => $task?->status
        ]);

        $this->email = new Email([
            'title' => 'Email',
            'minlength' => 4,
            'maxlength' => 50,
            'value' => $task?->email
        ]);

        $this->content = new Textarea([
            'title' => 'Описание',
            'minlength' => 1,
            'maxlength' => 4000,
            'value' => $task?->content
        ]);
    }
}