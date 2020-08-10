<?php require(__DIR__ . '/../header.php'); ?>

<div>

    <form id="change-password-form">
        <div id="message"></div>
        <table>
            <tr>
                <td>Пароль</td>
                <td><input type="password" id="password" name="password" maxlength="20"/></td>
            </tr>
            <tr>
                <td>Повторите пароль</td>
                <td><input type="password" id="repeat_password" name="repeat_password" maxlength="20"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="auth" value="Сменить пароль"/></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="/">Главная страница</a></td>
            </tr>
        </table>
    </form>
</div>

<script>
    $('#change-password-form').submit(function() {
        //alert();
        $.post('/changePasswordAjax', $('#change-password-form').serialize(), function(data){
            if(!data.status) {
                $('#message').html(data.error);
            }
            else {
                alert('Ваш пароль успешно изменен!');

                $('#message').html('');
                $('#password').val('');
                $('#repeat_password').val('');
            }
        });

        return false;
    })
</script>

<?php require(__DIR__ . '/../footer.php'); ?>
