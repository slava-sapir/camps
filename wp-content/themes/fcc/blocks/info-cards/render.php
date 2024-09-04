<?php
/**
 * Info Cards Block Template.
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

$anchor = isset($block['anchor']) ? $block['anchor'] : '';
$classes = isset($block['className']) ? $block['className'] : '';
?>

<section class="info-cards <?= esc_attr($classes) ?>" id="<?= esc_attr($anchor) ?>" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container container-ed">
        <h2 class="text-center"><?= get_field('heading'); ?></h2>
        <div class="row gy-50 gx-md-50">
            <?php while(have_rows('info_cards')): the_row();
                $title = get_sub_field('title');
                $image = get_sub_field('image');
                $link = get_sub_field('link'); ?>
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="info-card rounded fcc-shadow position-relative d-flex flex-column align-self-stretch w-100">
                        <?= wp_get_attachment_image( $image['id'], 'full', false, ['class' => 'img-fluid text-center'] ); ?>
                        <div class="info-card-text tile-shadow pt-40 px-20">
                            <h3 class="h4 text-center text-white"><?= $title ?></h3>
                            <div class="text-center"><a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>" class="btn stretched-link"><?= $link['title']; ?></a></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>