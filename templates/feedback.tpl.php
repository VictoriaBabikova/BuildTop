<div class='content'>
    <div class='container'>
        <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
            <div class="container_form">
                <div id="send-form">
                    <div>
                        <h2>Форма обратной связи</h2>
                        <img src="img/feedback.svg" width="60" alt="profile_logo">
                    </div>
                    <form action="" id="send_message">
                        <?php foreach ($arrayUser as $key => $value) : ?>
                            <label for ='user_name'>Логин</label>
                            <input type="text" id="user_name" name="name" required value="<?= $value['user_name'] ?>">
                            <label for='user_email'>Почта</label>
                            <input type="email" name="email" id="user_email" required value="<?= $value['user_email'] ?>">
                            <label for="message">Сообщение</label>
                            <textarea rows="10" cols='35' name="message" id="message" required></textarea>
                        <?php endforeach ?>
                        <input type="submit" id="change" value="ОТПРАВИТЬ СООБЩЕНИЕ" name="SendMessageSubmit">
                    </form>
                </div>
            </div>    
        <?php else : ?>
            <p class="auth_message">Пожалуйста, авторизуйтесь на портале. Только авторизированные пользователи могут отправлять сообщения.</p>
        <?php endif; ?>
    </div>
</div>