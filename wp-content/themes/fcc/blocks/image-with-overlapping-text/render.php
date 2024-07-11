<?php
/**
 * Image with Overlapping Text.
 *
* @param array $block The block settings and attributes.
* @param string $content The block inner HTML (empty).
* @param bool $is_preview True during backend preview render.
* @param int $post_id The post ID the block is rendering content against.
*        This is either the post ID currently being displayed inside a query loop,
*        or the post ID of the post hosting this block.
* @param array $context The context provided to the block by the post or it's parent block.
* 
* @package Forest_Cliff_Camps
*/


if(have_rows('image_text_rows')) :
?>
<section id="image-text-rows" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container">
        <?php while(have_rows('image_text_rows')) : the_row(); 
        $image_position = 'order-lg-2';
        $image_margin = 'ms-lg-n80';
        $text_position = 'order-lg-1';
        if(get_row_index() % 2 == 0) :
            $image_position = 'order-lg-1';
            $image_margin = 'me-lg-n80';
            $text_position = 'order-lg-2';
        endif;
        $image = get_sub_field('image');
        $text_content = get_sub_field('text_content'); ?>
            <div class="row align-items-center py-50">
            
                <div class="col-lg-6 <?= $image_position; ?>">
                    <?php if( $image ): ?>
                        <div class="image-block <?= $image_margin; ?> ">
                            <img src="<?php echo esc_url($image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($image['alt']); ?>" style="border-radius: 8px;">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 <?= $text_position; ?>">
                    <div class="text-block p-40 bg-white tile-shadow rounded z-1 position-relative">
                        <?php if( $text_content ): ?>
                            <div><?php echo wp_kses_post($text_content); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>