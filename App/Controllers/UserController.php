<?php


namespace App\Controllers;


use App\Engine\Text;
use App\Forms\LoginForm;
use App\Models\User;

class UserController extends BaseController
{
    public function loginAction()
    {
        $loginForm = new LoginForm();

        if ($this->request->isPost()) {
            if ($loginForm->process($_POST)) {
                $in_username = $loginForm->get('username');
                $in_password = $loginForm->get('password');
                $in_password = User::hashPassword($in_password);

                $incomer = User::findOne(
                    where: "`username` = :username AND `password` = :password",
                    binds: [
                        'username' => $in_username,
                        'password' => $in_password
                    ]
                );

                if (!$incomer) {
                    $this->flash->danger('Связка логин/пароль не найдена!');
                } else {
                    $new_session = Text::base62SafeGenerate(32);

                    if ($incomer->setSession($new_session)->update()) {

                        $this->session->userId = $incomer->id;

                        return $this->response->redirect('/');
                    }
                }
            }
        }

        $this->view->form = $loginForm;
        $this->view->render('Index');
    }

    public function logoutAction()
    {
        unset($this->session->userId);
        return $this->response->redirect('/');
    }
}