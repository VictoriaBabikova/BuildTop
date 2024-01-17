<div class="content">
    <div class="container">
        <?php if (isset($_SESSION['admin'])) : ?>
            <div class="wraper_panel">
                <div class="container_adm_panel">
                    <h2>Добро пожаловать <?php print_r($_SESSION['user_name']) ?></h2>
                    <div>
                        <div class="new">Новые темы
                            <span class="quantity">
                                <?php print_r(count($topics_moder)) ?>
                            </span>
                        </div>
                        <div class="new">Новые заказы
                            <span class="quantity">
                                <?php print_r(count($order_moder_list)) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="container_adm_panel_1">
                    <div class="users">
                        <p style="text-align: center;">Список зарегистрированных пользователей</p>
                        <table>
                            <tr>
                                <th>#id</th>
                                <th>имя</th>
                                <th>емайл</th>
                                <th>дата рег-ции</th>
                                <th>статус</th>
                            </tr>
                            <?php for ($i = 0; $i < count($user_info_arr); $i++) : ?>
                                <tr>
                                    <td><?php print_r($user_info_arr[$i]['user_id']) ?></td>
                                    <td><?php print_r($user_info_arr[$i]['user_name']) ?></td>
                                    <td><?php print_r($user_info_arr[$i]['user_email']) ?></td>
                                    <td><?php print_r($user_info_arr[$i]['user_date']) ?></td>
                                    <td>
                                        <?php if ($user_info_arr[$i]['user_level'] == 0) : ?>
                                            user
                                        <?php else : ?>
                                            admin
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </table>

                    </div>
                    <form action="/admin/topic_to_moder" method="POST" id="id_form_pan_1" class="info_admin">
                        <h3>Добавление тем</h3>
                        <label for="topic">Список тем и категорий</label>
                        <select size="5" multiple name="topic">
                            <?php for ($i = 0; $i < count($category); $i++) : ?>
                                <optgroup label="<?php print_r([$i + 1][0]) ?>.&nbsp;<?php print_r($category[$i]['cat_name']) ?>">
                                    <?php foreach ($topics as $value) : ?>
                                        <?php if ($value['topic_cat'] == $category[$i]['cat_id']) : ?>
                                            <option><?php print_r($value['topic_subject']) ?></option>
                                        <?php elseif (!($value['topic_cat'] == $category[$i]['cat_id'])) : ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endfor; ?>
                        </select>
                        <label for=category> #id предполагаемой категории</label>
                        <input type="text" value=" <?php (isset($topics_moder[0]['topic_cat'])) ? print_r($topics_moder[0]['topic_cat']) : '' ?>" name="category" class="input_adm">
                        <label for="name_topic">Название темы </label>
                        <textarea rows="10" cols="35" name="name_topic" required><?php (isset($topics_moder[0]['topic_subject'])) ? print_r($topics_moder[0]['topic_subject']) : '' ?></textarea>

                        <div class='wrap_button'>
                            <input type="submit" value="ДОБАВИТЬ" class="admin-button_3" name="topic_to_moder_base">
                            <input type="submit" value="УДАЛИТЬ" class="admin-button_4" name="topic_to_moder_delete">
                        </div>
                    </form>


                    <form action="/admin/change_category" method="POST" id="id_form_pan_2" class="info_admin">
                        <h3>Добавление категорий</h3>
                        <label for="category">Список всех категорий</label>
                        <select size="5" multiple name="category">
                            <?php for ($i = 0; $i < count($category); $i++) : ?>
                                <option value="" hidden>Выбрать</option>
                                <option><?php print_r([$i + 1][0]) ?>.&nbsp;<?php print_r($category[$i]['cat_name']) ?></option>
                            <?php endfor; ?>
                        </select>
                        <label for="name_category">Название новой категории </label>
                        <textarea rows="10" cols="35" name="name_category" required></textarea>
                        <label for="subject_category">Описание новой категории </label>
                        <textarea rows="10" cols="35" name="subject_category" required></textarea>
                        <div style="height: 55px;">
                            <input type="submit" value="ДОБАВИТЬ" class="admin-button_1" name="change_category">
                        </div>
                    </form>
                </div>

                <div class="container_adm_panel_2">
                    <form action="/admin/order_to_moder" method="POST" class="info_admin" id="make_order">
                        <h3>Добавление заказов</h3>
                        <label for="id">Предложил заказ пользователь #id</label>
                        <input type="text" name="id" value="<?php print_r($order_moder_list[0]['order_by']) ?>" class="input_adm">
                        <label for="order_city">Локация заказа</label>
                        <input type="text" name="order_city" value="<?php print_r($order_moder_list[0]['order_city']) ?>" class="input_adm">
                        <label for="order_tel">Контакт заказа для связи</label>
                        <input type="text" name="order_tel" value="<?php print_r($order_moder_list[0]['order_tel']) ?>" class="input_adm">
                        <label for="order_content">Описание заказа </label>
                        <textarea rows="10" cols="35" name="order_content" required><?php print_r($order_moder_list[0]['order_content']) ?></textarea>
                        <label for="message">Сообщение автору (при редактировании) </label>
                        <textarea rows="10" cols="35" name="message"></textarea>

                        <div class='wrap_button_1'>
                            <input type="submit" value="ДОБАВИТЬ" class="admin-button_5" name="order_to_moder_base">
                            <input type="submit" value="РЕДАКТИРОВАТЬ" class="admin-button_6" name="order_to_moder_change">
                            <input type="submit" value="УДАЛИТЬ" class="admin-button_7" name="order_to_moder_delete">
                        </div>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <p class="auth_message">Пожалуйста, авторизируйтесь на портале.</p>
        <?php endif; ?>
    </div>
</div>