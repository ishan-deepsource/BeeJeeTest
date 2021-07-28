<?php


namespace App\Controllers;


use App\Models\User;

/**
 * Class BaseController
 * @property \App\Engine\Session $session
 * @property \App\Engine\Flash $flash
 * @package App\Controllers
 */
class BaseController extends \App\Engine\Controller
{
    public ?User $user = null;

    public function initialize()
    {
        if ($userId = $this->session->userId) {
            $this->user = User::findOne(where: "`id` = {$userId}");
        }

        $this->view->user = $this->user;
    }

    public function notFoundAction()
    {
        echo '404 not found error';
    }
}