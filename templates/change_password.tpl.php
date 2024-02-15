<div class="content">
    <div class="container">
        <div id="login-form">
            <h2>Восстановить пароль</h2>
            <form action="/save_password" method="post" id="formId" enctype="application/x-www-form-urlencoded">
                <input type="hidden" name="name" value="<?php print_r($_GET['user_name']) ?>"><br>
                <input type="hidden" name="email" value="<?php print_r($_GET['email']) ?>"><br>
                <label for="password-input">Укажите новый пароль</label>
                <input type="password" id="password-input" name="password" required value="Пароль" onBlur="if(this.value=='')this.value='Пароль'" onFocus="if(this.value=='Пароль')this.value='' ">
                <?php isset($message_user) ? print $message_user : '' ?>
                <?php isset($message) ? print $message : '' ?>
                <input type="submit" value="ОТПРАВИТЬ" name="ChangeSubmit">
            </form>
        </div>
    </div>
</div>