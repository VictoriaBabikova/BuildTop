<div class="content">
    <div class="container">
            <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
                <div class="container_form">
                    <div id="send-form">
                        <div>
                            <h2>Форма новой темы для обсуждения</h2>
                            <img src="img/feedback.svg" width="60" alt="profile_logo">
                        </div>
                        <form action="" method="POST">
                            <label for="category">Выберите категорию в которой хотите создать обсуждение</label>
                            <select name="category">
                                <?php for ($i = 0; $i < count($category); $i++) : ?>
                                    <option><?php print_r($category[$i]['cat_name']) ?></option>
                                <?php endfor; ?>
                            </select>
                            <label for="name_topic">Напишите название темы которую хотите обсудить
                            </label>
                            <textarea rows="10" cols="35" name="name_topic" required></textarea>
                            <input type="submit" value="ОТПРАВИТЬ НА МОДЕРАЦИЮ" name="topic_to_moder">
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <p class="auth_message">Пожалуйста, авторизуйтесь на портале. Только авторизированные пользователи могут создавать темы для обсуждения.</p>
            <?php endif; ?>
    </div>
</div>