<div class='content'>
            <div class='container'>
            <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
                <div class ='container_message'>
                    <?php foreach ($order_moder_redact as $value) : ?>
                        <?php if ($value['order_by'] == $_SESSION['id']) : ?>
                            <form action='/add_order_to_moder_again' method='POST' id='change_order'>
                                <h3 style='text-align:center;padding-top:20px'>Ваш заказ</h3>
                                <input type='hidden' name='order_id' value='<?php print_r($value['order_id']) ?>' class='input_adm'>
                                <input type='hidden' name='id' value='<?php print_r($value['order_by']) ?>' class='input_adm'>
                                <label for='order_city'>Локация заказа</label>
                                <input type='text' name='order_city' value='<?php print_r($value['order_city']) ?>' class='input_adm'>
                                <label for='order_tel'>Контакт заказа для связи</label>
                                <input type='text' name='order_tel' value='<?php print_r($value['order_tel']) ?>' class='input_adm'>
                                <label for='order_content'>Описание заказа </label>
                                <textarea rows='10' cols='35' name='order_content' required><?php print_r($value['order_content']) ?></textarea>
                                <input type='submit' value='ОТПРАВИТЬ НА МОДЕРАЦИЮ' id='message-button_user' name='order_to_moder_again'> 
                            </form>
                            <div class='moder_message'>
                                <h3>Сообщение от модератора</h3>
                                <?php foreach ($messages_arr as $value) : ?>
                                    <?php if ($value['id_user'] == $_SESSION['id']) : ?> 
                                        <div>
                                            <p>Ваш заказ был отклонен от публикации</p> 
                                            <h4 style= 'text-align:center'><?php print_r($value['message_content']) ?></h4> 
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>          
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>    
        </div>
    </div>