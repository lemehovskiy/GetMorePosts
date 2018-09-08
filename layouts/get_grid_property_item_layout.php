<?php function get_grid_property_item_layout($property_ID, $box_type)
{

    ob_start();

    if ($box_type == 'type-1'): ?>

        <?php $is_box_with_image = get_field('image', $property_ID); ?>

        <div class="grid-item <?php echo $box_type; ?> <?php if ($is_box_with_image) echo 'with-image' ?>">
            <div class="wrap-item">
                <?php if ($is_box_with_image): ?>
                    <img src="<?php echo wp_get_attachment_image_src(get_field('image', $property_ID), 'large')[0]; ?>" alt="image">
                <?php endif; ?>

                <div class="content-wrap">
                    <div class="price">
                        $<?php echo number_format(get_field('loan_amount', $property_ID)); ?><br>
                    </div>
                    <div class="info">
                        <?php the_field('loan_purpose', $property_ID) ?><br>
                        <?php echo get_term_by('id', get_field('loan_type_id', $property_ID), 'property_loan_type')->name; ?>
                        <br>
                        <?php echo get_term_by('id', get_field('property_type_id', $property_ID), 'property_type')->name; ?><br>
                        <?php the_field('loan_term_in_years', $property_ID) ?> Year Term<br>

                        <?php the_field('city', $property_ID) ?>, <?php the_field('state', $property_ID) ?>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($box_type == 'type-2'): ?>
        <div class="grid-item <?php echo $box_type; ?>">
            <div class="wrap-item">
                <div class="content-wrap">
                    <div class="quote">
                        <?php the_sub_field('quote_text') ?>
                    </div>
                    <div class="author">
                        <?php the_sub_field('quote_author') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;

    $template = ob_get_contents();

    ob_get_clean();


    return $template;
}