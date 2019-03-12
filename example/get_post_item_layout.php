<?php function get_post_item_layout($postID)
{
    ob_start(); ?>

    <li class="section-latest-posts__post-item">
        <div class="section-latest-posts__post-item-inner">
            <div class="section-latest-posts__post-item-photo back_img"
                 style="background-image: url('<?php echo wp_get_attachment_image_src(get_field('photo', $postID), 'large')[0]; ?>')">
            </div>

            <div class="section-latest-posts__post-item-description">

                <div class="section-latest-posts__post-item-description-inner">
                    <div class="section-latest-posts__post-item-date">
                        <?php echo get_the_date('d/m/Y', $postID) ?>
                    </div>

                    <div class="section-latest-posts__post-item-title">
                        <?php echo get_the_title($postID); ?>
                    </div>

                    <div class="section-latest-posts__post-item-subtitle">
                        <?php the_field('subtitle', $postID) ?>
                    </div>

                    <div class="section-latest-posts__post-item-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <?php
    $template = ob_get_contents();

    ob_get_clean();

    return $template;
}