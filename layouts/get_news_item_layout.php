<?php function get_news_item_layout($news_ID)
{

    ob_start(); ?>

    <div class="item">

        <a href="<?php echo '?news-id=' . $news_ID .'#form-4' ?>"
           class="title-news"><?php echo mb_strimwidth(get_the_title($news_ID), 0, 100, '...'); ?>
            - <span class="date"><?php echo get_the_date('m/d/Y', $news_ID); ?></span>
        </a>

        <div class="content">
            <?php

            if (has_excerpt()) {
                echo get_the_excerpt($news_ID);
            } else {
                echo wp_html_excerpt(get_the_content($news_ID), 300, ' ... ');
            } ?>
        </div>
    </div>

    <?php
    $template = ob_get_contents();

    ob_get_clean();


    return $template;
}