<div class="content">
    <div class="container">
        <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
            <div class='table_user'>
                <?php foreach ($orders as $value) : ?>
                    <?php for ($i = 0; $i < count($user_info_arr); $i++) : ?>
                        <?php if (($value['order_by'] == $user_info_arr[$i]['user_id'])) : ?>
                            <table>
                                <tr>
                                    <th rowspan='2' style='width:25%;vertical-align: top;border-right: 2px solid #d5d5d5;font-size:25px'><?php print_r($user_info_arr[$i]['user_name']) ?>
                                        <p class='reg_date'>регистрация<br><?php print_r($user_info_arr[$i]['user_date']) ?></p>
                                    </th>
                                    <th style='padding:10px 0;border-bottom: 3px solid #d5d5d5;display: flex;flex-wrap: wrap;justify-content: space-evenly;'>
                                        <span style='font-size:12px;'>город:&nbsp;<?php print_r($value['order_city']) ?> </span>
                                        <span style='font-size:12px'>телефон:&nbsp;<a href="tel:<?php print_r($value['order_tel']) ?>"><?php print_r($value['order_tel']) ?></a> </span>
                                        <span style='font-size:12px'>дата публикации:&nbsp;<?php print_r($value['order_date']) ?> </span>
                                    </th>
                                </tr>
                                <tr>
                                    <td style='vertical-align: top;height:100%'><span><?php print_r($value['order_content']) ?></span></td>
                                </tr>
                            </table>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php endforeach; ?>
                <div class='bottom'>&nbsp</div>
            </div>  
            <div class='footer_forum'>
                <a href="/order" class='button_forum'>Предложить заказ</a>
            </div>
        <?php else : ?>
            <p class="auth_message">Пожалуйста, авторизуйтесь на портале. Только авторизированные пользователи могут видеть список заказов.</p>
        <?php endif; ?>
    </div>
</div>
