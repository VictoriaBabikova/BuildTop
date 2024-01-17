<div class="content">
    <div class="container">
        <?php if (isset($_SESSION['user_name'])) : ?>
            <div class="intro_page">
                <h2>Добро пожаловать <?php echo $_SESSION['user_name'] ?>!</h2>
                <p><a href="logout">Выйти</a> из системы</p>
            </div>
        <?php else : ?>
            <p class="auth_message">Пожалуйста, авторизируйтесь на портале</p>
        <?php endif; ?>
    </div>
</div>