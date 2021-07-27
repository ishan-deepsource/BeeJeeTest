<?php


namespace App\Controllers;


use App\Models\User;

class BaseController extends \App\Engine\Controller
{
    public ?User $user = null;

    public function initialize()
    {
        if ($sessionId = $this->request->getCookie('SessionId') and ctype_alnum($sessionId))
        {
            $this->user = User::findOne(where: "`session` = '{$sessionId}'");
        }

        $this->view->user = $this->user;
    }

    public function notFoundAction()
    {
        echo '404 not found error';
    }
}