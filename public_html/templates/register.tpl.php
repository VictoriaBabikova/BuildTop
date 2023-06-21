<?php
require_once('./include/capcha.php');
?>
<div class="content">
    <div class="container">
        <div id="login-form">
            <h2>Регистрация на сайте</h2>
            <form action="/register" method="post" id="formId" enctype="application/x-www-form-urlencoded">
                <input type="text" name="name" required value="Имя" onBlur="if(this.value=='')this.value='Имя'" onFocus="if(this.value=='Имя')this.value='' ">

                <input type="email" name="email" required value="E-mail" onBlur="if(this.value=='')this.value='E-mail'" onFocus="if(this.value=='E-mail')this.value='' ">
                <div class="password_cont">
                    <input type="password" id="password-input" name="password" required value="Пароль" onBlur="if(this.value=='')this.value='Пароль'" onFocus="if(this.value=='Пароль')this.value='' ">
                    <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
                </div>
                <?php isset($message_user) ? print $message_user : '' ?>
                <div class="wrap_captcha">
                    <label for name=" text_kapcha">
                        Пожалуйста, напишите <br>
                        <img width="120px" height="120" src="./css/capcha/<?= $array[$array_rand] ?>.jpg" title="<?= $word ?>">&nbsp;,<br>
                        если сомневаетесь наведите мышку на картинку <br>
                        <?php isset($message) ? print $message : '' ?>
                    </label>
                </div>
                 <select name="text_capcha" required>
                    <option value="" disabled>выберите название животного</option>
                    <option value="слон">слон</option>
                    <option value="кот">кот</option>
                    <option value="крокодил">крокодил</option>
                    <option value="мышь">мышь</option>
                    <option value="петух">петух</option>
                    <option value="конь">конь</option>
                </select><br>

                <input type="hidden" name="hidden_capcha" value="<?= $word ?>"><br>
                <div class="checkbox_reg">
                    <input type="checkbox" name="remember" id="rememberMy">
                    <label for="remebber">запомнить меня</label>
                </div>
                <input type="submit" value="ВОЙТИ" name="RegisterSubmit">
            </form>
        </div>
    </div>
</div>