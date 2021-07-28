<?php


namespace App\Controllers;


use App\Forms\Tasks\ComposeForm;
use App\Models\Task;

class TaskController extends BaseController
{
    public function composeAction($id)
    {
        if (!$this->user) {
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

                if ($task->save()) {
                    $this->flash->success('Задача успешно сохранена!');
                    return $this->response->redirect('/');
                }
            }
        }


        $this->view->form = $composeForm;
        $this->view->render('Index');
    }
}