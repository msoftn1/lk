<?php require(__DIR__ . '/../header.php'); ?>

<div>

    <form id="register-form">
        <div id="message"></div>
        <table>
            <tr>
                <td>E-mail</td>
                <td><input type="email" name="email" maxlength="255"/></td>
            </tr>
            <tr>
                <td>Логин</td>
                <td><input type="text" name="login" maxlength="20"/></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input type="password" name="password" maxlength="20"/></td>
            </tr>
            <tr>
                <td>ФИО</td>
                <td><input type="text" name="fio" maxlength="255"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="auth" value="Зарегистрироваться"/></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="/">Авторизоваться</a></td>
            </tr>
        </table>
    </form>
</div>

<script>
    $('#register-form').submit(function() {
        //alert();
        $.post('/registerAjax', $('#register-form').serialize(), function(data){
            if(!data.status) {
                $('#message').html(data.error);
            }
            else {
                alert('Вы успешно зарегистрированы!');
                window.location.href = '/';
            }
        });

        return false;
    })
</script>

<?php require(__DIR__ . '/../footer.php'); ?>
