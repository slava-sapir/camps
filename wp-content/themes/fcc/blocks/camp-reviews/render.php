<?php
/**
 * Camp Reviews Block Template.
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

<section id="<?= esc_attr($anchor) ?>" class="camp-reviews <?= esc_attr($classes) ?>"
         style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container position-relative">
        <div class="swiper review-swiper">
            <div class="swiper-wrapper">
                <?php foreach (get_field('reviews') as $post):
                    setup_postdata($post); ?>
                    <div class="swiper-slide">
                        <div class="text-center text-white fs-5"><?php the_content(); ?></div>
                        <?php if (has_post_thumbnail($post->ID)): ?>
                            <div class="text-center pb-10">
                                <?= get_the_post_thumbnail($post->ID, 'review-thumb', ['class' => 'rounded-circle']); ?>
                            </div>
                        <?php endif; ?>
                        <p class="text-center text-white"><?= get_the_title($post->ID); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
    </div>
</section>