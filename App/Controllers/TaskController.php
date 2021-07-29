<?php


namespace App\Controllers;


use App\Forms\Tasks\ComposeForm;
use App\Models\Task;

class TaskController extends BaseController
{
    public function composeAction($id)
    {
        if (!empty($id) and !$this->user) {
            $this->flash->danger('Редактировать задачу может только администратор!');

            return $this->response->redirect('/');
        }

        if (empty($id) or !$task = Task::findOne(where: "`id` = {$id}")) {
            $task = new Task();
        }

        $composeForm = new ComposeForm($task);

        if ($this->request->isPost()) {
            if ($composeForm->process($_POST)) {
                $task
                    ->setStatus($composeForm->get('status'))
                    ->setName($composeForm->get('name'))
                    ->setEmail($composeForm->get('email'))
                    ->setContent($composeForm->get('content'));

                if (!isset($this->user))
                {
                    $task->setStatus(0);
                }

                if ($task->save()) {
                    $this->flash->success('Задача успешно сохранена!');
                    return $this->response->redirect('/');
                }
            }
        }

        $this->view->task = $task;
        $this->view->form = $composeForm;
        $this->view->render('Index');
    }
}