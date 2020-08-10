<?php

/**
 * Контроллер пользователей.
 */
class UserController extends AbstractController
{
    /**
     * Авторизация.
     */
    public function authAction(): void
    {
        $login = trim($_REQUEST['login']);
        $password = $_REQUEST['password'];

        $userService = new UserService();

        $this->responseJson(
            $userService->auth($login, $password)
        );
    }

    /**
     * Регистрация.
     *
     * @throws Exception
     */
    public function registerAction(): void
    {
        $this->render('user/register');
    }

    /**
     * Регистрация (обработка отправки формы).
     */
    public function registerAjaxAction(): void
    {
        $email = trim($_REQUEST['email']);
        $login = trim($_REQUEST['login']);
        $password = $_REQUEST['password'];
        $fio = trim($_REQUEST['fio']);

        $userService = new UserService();

        $this->responseJson(
            $userService->register($email, $login, $password, $fio)
        );
    }

    /**
     * Изменение пароля.
     *
     * @throws Exception
     */
    public function changePasswordAction(): void
    {
        $this->render('user/changePassword');
    }

    /**
     * Изменение пароля (обработка отправки формы).
     */
    public function changePasswordAjaxAction(): void
    {
        $password = $_REQUEST['password'];
        $repeatPassword = $_REQUEST['repeat_password'];

        $userService = new UserService();

        $this->responseJson(
            $userService->changePassword(Auth::getUserId(), $password, $repeatPassword)
        );
    }

    /**
     * Изменение фио.
     *
     * @throws Exception
     */
    public function changeFioAction(): void
    {
        $userService = new UserService();

        $this->render('user/changeFio',
            [
                'user' => $userService->getUserById(Auth::getUserId())
            ]
        );
    }

    /**
     * Изменение фио (обработка отправки формы).
     */
    public function changeFioAjaxAction(): void
    {
        $fio = trim($_REQUEST['fio']);

        $userService = new UserService();

        $this->responseJson(
            $userService->changeFio(Auth::getUserId(), $fio)
        );
    }

    /**
     * Выход.
     */
    public function logoutAction(): void
    {
        $userService = new UserService();
        $userService->logout();

        $this->redirectTo('/');
    }
}
