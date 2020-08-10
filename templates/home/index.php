<?php require(__DIR__ . '/../header.php'); ?>
<?php if (Auth::check()) { ?>
    <div>
        <table>
            <tr>
                <td>Здравствуйте, <?=$user['fio'];?></td>
            </tr>
            <tr>
                <td><a href="/changePassword">Сменить пароль</a></td>
            </tr>
            <tr>
                <td><a href="/changeFio">Сменить фио</a></td>
            </tr>
            <tr>
                <td><a href="/logout">Выход</a></td>
            </tr>
        </table>
    </div>
<?php } else { ?>
    <div>
        <form id="auth-form">
            <div id="message"></div>
            <table>
                <tr>
                    <td>Логин</td>
                    <td><input type="text" name="login"/></td>
                </tr>
                <tr>
                    <td>Пароль</td>
                    <td><input type="password" name="password"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="auth" value="Войти"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="/register">Регистрация</a></td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        $('#auth-form').submit(function() {
            $.post('/auth', $('#auth-form').serialize(), function(data){
                if(!data.status) {
                    $('#message').html(data.error);
                }
                else {
                    alert('Вы успешно авторизованы!');
                    window.location.href = '/';
                }
            });

            return false;
        })
    </script>
<?php } ?>
<?php require(__DIR__ . '/../footer.php'); ?>
