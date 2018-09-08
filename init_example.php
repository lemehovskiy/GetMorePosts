<?php

$get_more_properties = new GetMorePosts(
    array(
        'action' => 'get_more_properties',
        'layout_function_name' => 'get_grid_property_item_layout',
        'layout_function_arg' => 'type-1',
        'validation_config' => array(
            'post_per_page_limit' => 20,
            'available_args_parameters' => array(
                'post_type',
                'posts_per_page',
                'meta_query',
                'post__not_in',
                'offset',
                'order',
                'orderby',
                'date_query',
                'tax_query'
            ),
            'available_post_types' => array('property'),
            'available_meta_keys' => array('loan_type_id', 'loan_officer_id', 'clsd_date')
        )
    )
);


$get_more_news = new GetMorePosts(
    array(
        'action' => 'get_more_news',
        'layout_function_name' => 'get_news_item_layout',
        'validation_config' => array(
            'post_per_page_limit' => 20,
            'available_args_parameters' => array(
                'post_type',
                'posts_per_page',
                'meta_query',
                'post__not_in',
                'offset',
                'order',
                'orderby',
                'date_query',
                'tax_query'
            ),
            'available_post_types' => array('post'),
            'available_meta_keys' => array('loan_type_id', 'loan_officer_id', 'clsd_date')
        )
    )
);