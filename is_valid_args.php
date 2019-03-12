<?php

function is_valid_args($options){
    //check available args parameters
    foreach ($options['args'] as $key => $value) {
        if (!in_array($key, $options['validation_config']['available_args_parameters'])) {
            throw new Exception($key . ' - invalid arg parameter');
        }
    }

    //check available post types
    if (!in_array($options['args']['post_type'], $options['validation_config']['available_post_types'])) {
        throw new Exception('invalid post type');
    };

//    check for max post per page limit
    if ($options['args']['posts_per_page'] > $options['validation_config']['posts_per_page_limit']) {
        throw new Exception('post per page limit');
    }

    //check available meta keys
    if (isset($options['args']['meta_query'])) {
        foreach ($options['args']['meta_query'] as $query_rule) {
            if (is_array($query_rule) && array_key_exists('key', $query_rule)) {
                if (!in_array($query_rule['key'], $options['validation_config']['available_meta_keys'])) {
                    throw new Exception('invalid meta key');
                    break;
                }
            }
        }
    }

    return true;
}