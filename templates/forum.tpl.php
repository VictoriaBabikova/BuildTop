<div class="content">
    <div class="container">
        <div class="wrap_forum">
                <?php for ($i = 0; $i < count($category); $i++) : ?>
                    <div class="category_forum">
                        <ul>
                            <h3><?php print_r($category[$i]['cat_name']) ?></h3>
                            <?php foreach ($topics as $value) : ?>
                                <?php if ($value['topic_cat'] == $category[$i]['cat_id']) : ?>
                                    <li>
                                        <a href="/forum/topic_page?id_topic=<?php print_r($value['topic_id']) ?>"><?php print_r($value['topic_subject'])?></a>
                                    </li>
                                    <hr>
                                <?php elseif (!($value['topic_cat'] == $category[$i]['cat_id'])) : ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endfor; ?>
            <div class='bottom'>&nbsp</div>
            <div class='footer_forum'>
                <a href='/add_topic' class='button_forum'>Создать тему</a>
            </div>
        </div>
    </div>
</div>