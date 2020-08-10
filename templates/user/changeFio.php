<?php require(__DIR__ . '/../header.php'); ?>

<div>

    <form id="change-fio-form">
        <div id="message"></div>
        <table>
            <tr>
                <td>ФИО</td>
                <td><input type="text" id="fio" name="fio" value="<?=$user['fio'];?>" maxlength="255"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Сменить фио"/></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="/">Главная страница</a></td>
            </tr>
        </table>
    </form>
</div>

<script>
    $('#change-fio-form').submit(function() {
        //alert();
        $.post('/changeFioAjax', $('#change-fio-form').serialize(), function(data){
            if(!data.status) {
                $('#message').html(data.error);
            }
            else {
                alert('Ваше фио успешно изменено!');

                $('#message').html('');
            }
        });

        return false;
    })
</script>

<?php require(__DIR__ . '/../footer.php'); ?>
