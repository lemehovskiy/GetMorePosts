<?php

$get_more_posts = new GetMorePosts(
    array(
        'action' => 'get_more_posts',
        'layout_function_name' => 'get_post_item_layout',
        'layout_function_arg' => null,
        'validation_config' => array(
            'posts_per_page_limit' => 20,
            'available_args_parameters' => array(
                'post_type',
                'posts_per_page',
                'meta_query',
                'post__not_in',
                'offset',
                'order',
                'orderby'
            ),
            'available_post_types' => array('post')
        )
    )
);