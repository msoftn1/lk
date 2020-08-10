<?php

/**
 * Основной класс приложения.
 */
class LkApplication
{
    /** Защищенные роуты. */
    private array $protectedRoutes = [
        '/changePasswordAjaxAction',
        '/changeFioAjaxAction',
        '/changePassword',
        '/changeFio',
        '/logout',
    ];

    /** Роуты для которых пользователь не должен быть авторизован. */
    private array $notProtectedRoutes = [
        '/auth',
        '/register',
        '/registerAjax',
    ];

    /**
     * Запуск приложения.
     *
     * @throws AccessException
     */
    public function start(): void
    {
        $this->routing();
    }

    /**
     * Роутинг.
     *
     * @throws AccessException
     */
    private function routing(): void
    {
        $request = $this->getPath();

        if ((in_array($request, $this->protectedRoutes) && !Auth::check())
            || (in_array($request, $this->notProtectedRoutes) && Auth::check())) {
            throw new AccessException("Доступ запрещен");
        }

        if ($request == '/') {
            $controller = new HomeController();
            $controller->indexAction();
        } else if ($request == '/auth') {
            $controller = new UserController();
            $controller->authAction();
        } else if ($request == '/register') {
            $controller = new UserController();
            $controller->registerAction();
        } else if ($request == '/registerAjax') {
            $controller = new UserController();
            $controller->registerAjaxAction();
        } else if ($request == '/changePassword') {
            $controller = new UserController();
            $controller->changePasswordAction();
        } else if ($request == '/changePasswordAjax') {
            $controller = new UserController();
            $controller->changePasswordAjaxAction();
        } else if ($request == '/changeFio') {
            $controller = new UserController();
            $controller->changeFioAction();
        } else if ($request == '/changeFioAjax') {
            $controller = new UserController();
            $controller->changeFioAjaxAction();
        } else if ($request == '/logout') {
            $controller = new UserController();
            $controller->logoutAction();
        } else {
            $controller = new HomeController();
            $controller->notFoundAction();
        }
    }

    /**
     * Получить роут.
     *
     * @return string
     */
    private function getPath(): string
    {
        $data = explode('?', $_SERVER['REQUEST_URI']);
        return $data[0];
    }
}
