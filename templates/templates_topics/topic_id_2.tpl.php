<div class='content'>
    <div class='container'>
        <div class='table_user'> 
            <?php foreach ($topic_user as $value) : ?>        
                <?php for ($i = 0; $i < count($user_info_arr); $i++) : ?>
                    <?php if (($value['topic_id'] == $id_topic)&& ($value['topic_by']==$user_info_arr[$i]['user_id'])) : ?>
                        <table>    
                            <tr>
                                <th rowspan='2' style='width:25%;vertical-align: top;border-right: 2px solid #d5d5d5;font-size:25px'><?php print_r($user_info_arr[$i]['user_name'])?>
                                    <p class='reg_date'>регистрация<br><?php print_r($user_info_arr[$i]['user_date'])?></p>
                                </th>
                                <th style='height:20px;' colspan='2'>
                                    <p style='font-size:12px'>сообщение опубликовано:&nbsp;<?php print_r($value['topic_date'])?> </p>
                                </th>
                            </tr>
                            <tr style='border-bottom: 3px solid #ffa184;'>
                                <td style='vertical-align: top;padding-top:10px'><?php print_r($value['topic_subject'])?></td>
                            </tr>
                        </table>
                    <?php endif; ?>      
                <?php endfor; ?>   
            <?php endforeach; ?> 
            <?php if (isset($array_post[0])) : ?>     
                <?php for ($i = 0; $i < count($post_user); $i++) : ?>
                    <table>                                
                        <tr>                                    
                            <th rowspan='2' style='width:25%;vertical-align: top;border-right: 2px solid #d5d5d5;font-size:25px'><?php print_r($post_user[$i]['user_name'])?>
                                <p class='reg_date'>регистрация<br><?php print_r($post_user[$i]['user_date'])?></p>
                            </th>
                            <th style='height:20px;' colspan='2'>
                                <p style='font-size:12px'>сообщение опубликовано:&nbsp;<?php print_r($post_user[$i]['post_date'])?> </p>
                            </th>
                        </tr>
                        <tr style='border-bottom: 3px solid #ffa184;'>
                            <td style='vertical-align: top;padding-top:10px'><?php print_r($post_user[$i]['post_content'])?></td>
                        </tr>                                   
                    </table>                 
                <?php endfor; ?> 
            <?php else : ?>
                <p style='padding: 15px 0 0 15px'>Здесь еще никто не чего не ответил ..</p>
            <?php endif; ?>
        </div>
        <div class='bottom'>&nbsp</div>
    
        <div class='footer_forum'>
            <a href='/post?id_topic=<?php print_r($value['topic_id']) ?>' class='button_forum'>Ответить</a>
            <a href='/add_topic' class='button_forum'>Создать тему</a>
        </div>  
    </div>
</div>