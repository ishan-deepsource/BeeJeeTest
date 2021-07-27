<?php


namespace App\Controllers;


use App\Engine\Pagination;
use App\Forms\FilterForm;
use App\Models\Task;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $filterForm = new FilterForm();


        if (isset($_GET['order']) and isset($_GET['sort']))
        {
            if ($filterForm->process($_GET))
            {
                // ???
            }
        }

        $this->view->tasks = new Pagination(
            class: Task::class,
            order: [$filterForm->order->getValue() => $filterForm->sort->getValue()],
            limit: 3
        );
        $this->view->form = $filterForm;
        $this->view->render('Index');
    }
}