<?php

declare(strict_types=1);

namespace App\Controller;

use App\DB;

class Forum
{
    /**
     * showForumPage
     *
     * @return void
     */
    public static function showForumPage()
    {
        $sql = [];
        $sql['sql']="SELECT * FROM `categories`";
        $category = DB::Select($sql['sql']);

        $sql['sql'] = "SELECT * FROM `topics`";
        $topics = DB::Select($sql['sql']);

        require_once "../templates/forum.tpl.php";
    }
    
    /**
     * getTopic
     *
     * @param  mixed $id_topic
     * @return void
     */
    public static function getTopic(int $id_topic)
    {
        $sql = [];
        $sql['sql'] = 'SELECT * FROM `topics` where topics.topic_id = :id_topic';
        $sql['param'] = [
            'id_topic' => htmlspecialchars(trim($id_topic)),
        ];
        $topic_user = DB::Select($sql['sql'], $sql['param']);

        $sql['sql'] = "SELECT * FROM `posts` where posts.post_topic = (SELECT topics.topic_id FROM `topics` where topics.topic_id = :id_topic)";
        $sql['param'] = [
            'id_topic' => htmlspecialchars(trim($id_topic)),
        ];
        $array_post = DB::Select($sql['sql'], $sql['param']);

        $sql['sql'] = "SELECT * FROM `users`";
        $user_info_arr = DB::Select($sql['sql']);


        if (isset($array_post)) {
            $sql['sql'] = "SELECT * FROM `users` left JOIN `posts` on users.user_id = posts.post_by where posts.post_topic = :id_topic";
            $sql['param'] = [
                'id_topic' => htmlspecialchars(trim($id_topic)),
            ];
            $post_user = DB::Select($sql['sql'], $sql['param']);
        }


$myfile = fopen("../templates/templates_topics/topic_id_".$id_topic.".tpl.php", "c+") or die("Unable to open file!");
    $txt = "<div class='content'>
    <div class='container'>
        <div class='table_user'> 
            <?php foreach (\$topic_user as \$value) : ?>        
                <?php for (\$i = 0; \$i < count(\$user_info_arr); \$i++) : ?>
                    <?php if ((\$value['topic_id'] == \$id_topic)&& (\$value['topic_by']==\$user_info_arr[\$i]['user_id'])) : ?>
                        <table>    
                            <tr>
                                <th rowspan='2' style='width:25%;vertical-align: top;border-right: 2px solid #d5d5d5;font-size:25px'><?php print_r(\$user_info_arr[\$i]['user_name'])?>
                                    <p class='reg_date'>регистрация<br><?php print_r(\$user_info_arr[\$i]['user_date'])?></p>
                                </th>
                                <th style='height:20px;' colspan='2'>
                                    <p style='font-size:12px'>сообщение опубликовано:&nbsp;<?php print_r(\$value['topic_date'])?> </p>
                                </th>
                            </tr>
                            <tr style='border-bottom: 3px solid #ffa184;'>
                                <td style='vertical-align: top;padding-top:10px'><?php print_r(\$value['topic_subject'])?></td>
                            </tr>
                        </table>
                    <?php endif; ?>      
                <?php endfor; ?>   
            <?php endforeach; ?> 
            <?php if (isset(\$array_post[0])) : ?>     
                <?php for (\$i = 0; \$i < count(\$post_user); \$i++) : ?>
                    <table>                                
                        <tr>                                    
                            <th rowspan='2' style='width:25%;vertical-align: top;border-right: 2px solid #d5d5d5;font-size:25px'><?php print_r(\$post_user[\$i]['user_name'])?>
                                <p class='reg_date'>регистрация<br><?php print_r(\$post_user[\$i]['user_date'])?></p>
                            </th>
                            <th style='height:20px;' colspan='2'>
                                <p style='font-size:12px'>сообщение опубликовано:&nbsp;<?php print_r(\$post_user[\$i]['post_date'])?> </p>
                            </th>
                        </tr>
                        <tr style='border-bottom: 3px solid #ffa184;'>
                            <td style='vertical-align: top;padding-top:10px'><?php print_r(\$post_user[\$i]['post_content'])?></td>
                        </tr>                                   
                    </table>                 
                <?php endfor; ?> 
            <?php else : ?>
                <p style='padding: 15px 0 0 15px'>Здесь еще никто не чего не ответил ..</p>
            <?php endif; ?>
        </div>
        <div class='bottom'>&nbsp</div>
    
        <div class='footer_forum'>
            <a href='/post?id_topic=<?php print_r(\$value['topic_id']) ?>' class='button_forum'>Ответить</a>
            <a href='/add_topic' class='button_forum'>Создать тему</a>
        </div>  
    </div>
</div>";

        fwrite($myfile, $txt);
        fclose($myfile);

        $_SESSION['id_topic'] = "id_topic_".$id_topic;
        require_once "../templates/templates_topics/topic_id_$id_topic.tpl.php";
    }
    
    /**
     * showNewTopicFormPage
     *
     * @return void
     */
    public static function showNewTopicFormPage()
    {
        $sql = [];
        $sql['sql']="SELECT * FROM `categories`";
        $category = DB::Select($sql['sql']);

        require_once "../templates/add_topic.tpl.php";
    }
    
    /**
     * addTopic
     *
     * @return void
     */
    public static function addTopic()
    {
        if (isset($_POST['topic_to_moder'])) {
            if (isset($_POST['name_topic']) && isset($_POST['category'])) {
                $id = $_SESSION['id'];
                $sql['sql'] = "INSERT INTO `topics_moder` (topics_moder.topic_subject,topics_moder.topic_date, topics_moder.topic_cat,topics_moder.topic_by) VALUES (:name_topic,NOW(),(SELECT categories.cat_id FROM `categories` WHERE categories.cat_name= :cat),:user_id)";
                $sql['param'] = [
                    'name_topic' => htmlspecialchars(trim($_POST['name_topic'])),
                    'cat' => htmlspecialchars(trim($_POST['category'])),
                    'user_id' => $id,
                ];
        
                DB::Query($sql['sql'], $sql['param']);
            }
            header('Location: /forum');
        }
    }
    
    /**
     * showPostPage
     *
     * @param  mixed $id_topic
     * @return void
     */
    public static function showPostPage(int $id_topic)
    {
        require_once "../templates/post.tpl.php";
    }
    
    /**
     * addPost
     *
     * @return void
     */
    public static function addPost()
    {
        if (isset($_POST['path_REFERER']) && isset($_POST['id']) && isset($_POST['new_post'])) {
            $sql['sql'] = "INSERT INTO `posts` (posts.post_content,posts.post_date, posts.post_topic,posts.post_by) VALUES (:new_post,NOW(),:id_topic,:id_user)";
            $sql['param'] = [
                    'new_post' => htmlspecialchars(trim($_POST['new_post'])),
                    'id_topic' => htmlspecialchars(trim($_POST['path_REFERER'])),
                    'id_user' =>  htmlspecialchars(trim($_POST['id'])),
                ];

            DB::Query($sql['sql'], $sql['param']);
        }
    
        $id_topic = $_POST['path_REFERER'];

        header("Location: ./forum/topic_page?id_topic=$id_topic");
    }
}
