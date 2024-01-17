<div class="content">
    <div class="container">
        <div id="login-form">
            <h2>Авторизация на сайте</h2>
            <form action="/login" method="post" id="formId" enctype="application/x-www-form-urlencoded">
                <input type="text" name="name" required value="Имя" onBlur="if(this.value=='')this.value='Имя'" onFocus="if(this.value=='Имя')this.value='' ">
                <input type="email" name="email" required value="E-mail" onBlur="if(this.value=='')this.value='E-mail'" onFocus="if(this.value=='E-mail')this.value='' ">
                <div class="password_cont">
                    <input type="password" id="password-input" name="password" required value="Пароль" onBlur="if(this.value=='')this.value='Пароль'" onFocus="if(this.value=='Пароль')this.value='' ">
                    <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
                </div>
                <?php isset($message_user) ? print $message_user : '' ?>
                <div class="checkbox">
                    <a href="/reset_password">Забыли пароль?</a>
                    <div>
                        <input type="checkbox" name="remember" id="rememberMy">
                        <label for="remebber">запомнить меня</label>
                    </div>
                </div>
                <input type="submit" value="ВОЙТИ" name="AuthSubmit">
            </form>
        </div>
    </div>
</div>