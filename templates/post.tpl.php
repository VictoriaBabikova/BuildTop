<div class="content">
    <div class="container">
        <div class="container_form">
            <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
                <div id="send-form">
                    <form action="/add_post" method="POST" id="addNew">
                        <div>
                            <h2>Форма нового сообщения</h2>
                            <img src="img/order_message.png" width="60" alt="profile_logo">
                        </div>
                        <input type="hidden" name="id" value="<?php print_r($_SESSION['id']) ?>">
                        <input type="hidden" name="path_REFERER" value="<?php print_r($id_topic) ?>">
                        <label for="new_post">Напишите сообщение
                        </label>
                        <textarea rows="10" cols="35" name="new_post" required></textarea>
                        <input type="submit" value="ОТПРАВИТЬ" name="make_new_post">
                    </form>
                    <p>* после отправки сообщение сразу же появится в теме обсуждения!</p>
                </div>
            <?php else : ?>
                <p class="auth_message">Пожалуйста, авторизуйтесь на портале. Только авторизированные пользователи могут отправлять сообщения.</p>
            <?php endif; ?>
        </div>
    </div>
</div>