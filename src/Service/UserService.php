<?php

/**
 * Сервис работы с пользователями.
 */
class UserService
{
    /**
     * Авторизовация пользователя.
     *
     * @param $login
     * @param $password
     * @return array
     */
    public function auth($login, $password): array
    {
        $dataQuery = Db::getInstance()->selectWithParameters(
            'SELECT * FROM user WHERE login=:login AND password=:password',
            [
                'login' => $login,
                'password' => sha1($password)
            ]
        );

        if(count($dataQuery) == 0) {
            $error = 'Пользователь с таким логином и паролем не найден.';
        }

        $data = [];

        if($error !== null) {
            $data['status'] = false;
            $data['error'] = $error;
        }
        else {
            $data['status'] = true;

            Auth::authenticate((int) $dataQuery[0]['id']);
        }

        return $data;
    }

    /**
     * Выход пользователя.
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Регистрация пользователя.
     *
     * @param $email
     * @param $login
     * @param $password
     * @param $fio
     * @return array
     */
    public function register($email, $login, $password, $fio): array
    {
        $error = null;
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
            $error = 'Укажите корректный E-mail';
        }
        else if(empty($login) || strlen($login) > 20) {
            $error = 'Не указан логин или его длина превышает 20 символов';
        }
        else if(empty($password) || strlen($password) > 20) {
            $error = 'Не указан пароль или его длина превышает 20 символов';
        }
        else if(empty($fio) || strlen($fio) > 255) {
            $error = 'Не указано фио или его длина превышает 255 символов';
        }
        else {
            $data = Db::getInstance()->selectWithParameters(
                'SELECT * FROM user WHERE login=:login OR email=:email',
                [
                    'login' => $login,
                    'email' => $email
                ]
            );

            if(count($data) > 0) {
                $error = 'Пользователь с таким логином или E-mail уже зарегистрирован.';
            }
        }

        $data = [];

        if($error !== null) {
            $data['status'] = false;
            $data['error'] = $error;
        }
        else {
            $data['status'] = true;

            DB::getInstance()->insertWithParameters(
                "INSERT INTO user (email,login,password,fio) VALUES (:email,:login,:password,:fio)",
                [
                    'email' => $email,
                    'login' => $login,
                    'password' => sha1($password),
                    'fio' => $fio
                ]
            );
        }

        return $data;
    }

    /**
     * Изменение пароля.
     *
     * @param $userId
     * @param $password
     * @param $repeatPassword
     * @return array
     */
    public function changePassword($userId, $password, $repeatPassword): array
    {
        $error = null;
        if(empty($password) || strlen($password) > 20) {
            $error = 'Не указан пароль или его длина превышает 20 символов';
        }
        else if($password !== $repeatPassword) {
            $error = 'Пароль и проверка паролей не совпадают';
        }

        $data = [];

        if($error !== null) {
            $data['status'] = false;
            $data['error'] = $error;
        }
        else {
            $data['status'] = true;

            DB::getInstance()->updateWithParameters(
                "UPDATE user SET password=:password WHERE id=:user_id",
                [
                    'password' => sha1($password),
                    'user_id' => $userId
                ]
            );
        }

        return $data;
    }

    /**
     * Изменение фио.
     *
     * @param $userId
     * @param $fio
     * @return array
     */
    public function changeFio($userId, $fio): array
    {
        $error = null;
        if(empty($fio) || strlen($fio) > 255) {
            $error = 'Не указано фио или его длина превышает 255 символов';
        }

        $data = [];

        if($error !== null) {
            $data['status'] = false;
            $data['error'] = $error;
        }
        else {
            $data['status'] = true;

            DB::getInstance()->updateWithParameters(
                "UPDATE user SET fio=:fio WHERE id=:user_id",
                [
                    'fio' => $fio,
                    'user_id' => $userId
                ]
            );
        }

        return $data;
    }

    /**
     * Получить пользователя по ID.
     *
     * @param $userId
     * @return array|null
     */
    public function getUserById($userId): ?array
    {
        $data = Db::getInstance()->selectWithParameters(
            'SELECT * FROM user WHERE id=:user_id',
            [
                'user_id' => $userId
            ]
        );

        if(count($data) == 0) {
            return null;
        }

        return $data[0];
    }
}
