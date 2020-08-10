<?php

/**
 * Главный контроллер.
 */
class HomeController extends AbstractController
{
    /**
     * Основное действие.
     * @throws Exception
     */
    public function indexAction(): void
    {
        $userService = new UserService();

        $this->render("home/index",
            [
                'user' => Auth::check() ? $userService->getUserById(Auth::getUserId()) : null
            ]
        );
    }

    /**
     * Действие, когда страница "не найдена".
     *
     * @throws Exception
     */
    public function notFoundAction(): void
    {
        $this->render("home/notFound", [], 404);
    }
}
