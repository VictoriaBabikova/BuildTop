<div class="content">
    <div class="container">
        <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
            <div id="login-form">
                <div>
                    <img src="img/profile.png" width="60" alt="profile_logo">
                    <h2>Мой профиль</h2>
                </div>
                <form action="/profile" method="post" id="formId">
                    <?php foreach ($arrayUser as $key => $value) : ?>
                        <label for name='name'>Логин</label>
                        <input type="text" id="user_name" name="name" required value="<?= $value['user_name'] ?>">
                        <label for name='email'>Почта</label>
                        <input type="email" name="email" id="user_email" required value="<?= $value['user_email'] ?>">
                        <label for name='password'>Введите пароль или создайте новый</label>
                        <input type="text" name="password" id="password" required value="" placeholder="пароль">
                        <p style="padding:5px 0;">Дата регистрации: <?= $value['user_date'] ?></p>
                        <p style="padding:5px 0;">Статус вашего аккаунта:
                            <?php if ($value['user_level'] == 1) : ?>
                                администратор
                            <?php else : ?>
                                пользователь
                            <?php endif; ?>
                        </p>
                    <?php endforeach ?>
                    <input type="submit" id="change" value="СОХРАНИТЬ ИЗМЕНЕНИЯ" name="ChangeProfileSubmit">
                </form>
                <a href="/user?id=<?php print_r($_SESSION['id']) ?>" class="deleteUserBtn">Удалить профиль</a>
            </div>
        <?php else : ?>
            <p class="auth_message">Пожалуйста, авторизируйтесь на портале</p>
        <?php endif; ?>
    </div>
</div>