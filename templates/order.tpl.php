<div class="content">
    <div class="container">
        <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
            <div class="container_form">
                <div id="send-form">
                    <form action="add_order_to_moder" method="POST" id="adNew_order">
                        <div>
                            <h2>Форма нового заказа</h2>
                            <img src="img/order.png" width="60" alt="profile_logo">
                        </div>
                        <input type="hidden" name="id" value="<?php print_r($_SESSION['id']) ?>">
                        <label for="order_city">Укажите город</label>
                        <input type="text" name="order_city" id="order_city" required placeholder="Мосва">
                        <label for="order_tel">Введите телефон для связи в формате: +78915545643</label>
                        <input type="tel" name="order_tel" id="order_tel" required placeholder="+7">
                        <label for="order_content">Опишите заказ</label>
                        <textarea rows="10" cols="35" name="order_content" id="order_content" required></textarea>
                        <input type="submit" value="ОТПРАВИТЬ НА МОДЕРАЦИЮ" name="make_new_order">
                    </form>
               </div> 
           </div>
        <?php else : ?>
            <p class="auth_message">Пожалуйста, авторизуйтесь на портале. Только авторизированные пользователи могут отправлять сообщения.</p>
        <?php endif; ?>       
    </div>
</div>