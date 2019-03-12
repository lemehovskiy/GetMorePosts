<?php

include "is_valid_args.php";

class GetMorePosts
{
    function __construct($config)
    {
        $this->validation_config = $config['validation_config'];
        $this->action = $config['action'];
        $this->layout_function_name = $config['layout_function_name'];
        $this->layout_function_arg = $config['layout_function_arg'];

        add_action('wp_ajax_nopriv_' . $this->action, array($this, 'get_more_posts'));
        add_action('wp_ajax_' . $this->action, array($this, 'get_more_posts'));
    }

    function get_more_posts()
    {
        $debug = true;
        $response = [];
        $args = $_POST['args'];

        try {
            is_valid_args(array(
                'args' => $args,
                'validation_config' => $this->validation_config,
            ));


            $the_query = new WP_Query($args);
            $response['args'] = $args;
            $response['validation_config'] = $this->validation_config;
            $response['foundPosts'] = $the_query->found_posts;

            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();

                    $response['items'] .= call_user_func($this->layout_function_name, get_the_ID(), $this->layout_function_arg);

                endwhile;
            endif;
            wp_reset_postdata();
        }
        catch (Exception $e){
            if ($debug) {
                $response['error'] = $e->getMessage();
            }
        }

        echo json_encode($response);

        die();
    }
}