<div class="content">
    <div class="container">
        <div id="login-form">
            <h2>Восстановить пароль</h2>
            <form action="/reset_password" method="post" id="formId" enctype="application/x-www-form-urlencoded">
                <input type="text" name="name" required value="Имя" onBlur="if(this.value=='')this.value='Имя'" onFocus="if(this.value=='Имя')this.value='' ">
                <input type="email" name="email" required value="E-mail" onBlur="if(this.value=='')this.value='E-mail'" onFocus="if(this.value=='E-mail')this.value='' ">
                <?php isset($message_user) ? print $message_user : '' ?>
                <?php isset($message) ? print $message : '' ?>
                <input type="submit" value="ОТПРАВИТЬ" name="ResetSubmit">
            </form>
        </div>
    </div>
</div>