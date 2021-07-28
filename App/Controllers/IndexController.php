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
        $filterOrder = ['id' => 'DESC'];

        if (isset($_GET['order']) and isset($_GET['sort'])) {
            if ($filterForm->process($_GET)) {
                $filterOrder = [$filterForm->order->getValue() => $filterForm->sort->getValue()];
            }
        }

        $this->view->tasks = new Pagination(
            class: Task::class,
            order: $filterOrder,
            limit: 3
        );
        $this->view->form = $filterForm;
        $this->view->render('Index');
    }
}