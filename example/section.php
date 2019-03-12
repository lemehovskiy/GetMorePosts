<section class="section-latest-posts">
    <div class="section-latest-posts__container">
        <h3 class="section-latest-posts__title">
            <span>
                Latest posts
            </span>
        </h3>


        <?php

        $start_posts_to_show = 2;
        $load_more_post_num = 2;

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $start_posts_to_show
        );

        $the_query = new WP_Query($args);

        ?>

        <?php if ($the_query->have_posts()) : ?>

            <?php $counter = 1; ?>

            <ul class="section-latest-posts__post-list">

                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                    <?php echo get_post_item_layout(get_the_ID()) ?>

                <?php endwhile; ?>

            </ul>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

        <?php
        $ajax_args = $args;
        $ajax_args["offset"] = $start_posts_to_show;
        $ajax_args["posts_per_page"] = $load_more_post_num;

        $load_more_data = array(
            "args" => $ajax_args
        );

        ?>

        <button class="section-latest-posts__load-more-btn <?php echo $the_query->found_posts < $start_posts_to_show ? 'no-more-posts' : null ?>" data-load-more='<?php echo json_encode($load_more_data) ?>'>Load more</button>

    </div>
</section>