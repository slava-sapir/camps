<?php
/**
 * Priorities Block Template.
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
$theme_colour = get_field('theme_colour', get_the_ID());
$bg_colour = 'bg-white';
if($theme_colour === 'gold-theme') :
    $bg_colour = 'bg-tan';
elseif ($theme_colour === 'teal-theme') :
    $bg_colour = 'bg-grey100';
endif;
?>

<section id="<?= esc_attr($anchor) ?>" class="priorities <?= esc_attr($classes) ?> <?= get_field('add_background_colour') ? $bg_colour : ''; ?>"
         style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">

    <InnerBlocks/>
    <div class="container">
        <div class="row justify-content-center gx-sm-40 gy-40">
            <?php while (have_rows('priorities')) : the_row(); ?>
                <div class="col-md-6 col-lg-4 col-xl-3 d-flex">
                    <div class="d-flex align-self-stretch w-100 flex-column">
                        <div class="text-center">
                            <?= wp_get_attachment_image(get_sub_field('image')['id'], 'priority-thumb', false, ['class' => 'img-fluid rounded-circle']); ?>
                        </div>
                        <?php if (get_sub_field('title')): ?>
                            <h3 class="h6 mt-20 mb-10 text-center px-10"><?= get_sub_field('title'); ?></h3>
                        <?php endif;
                        if (get_sub_field('content')): ?>
                            <p class="mb-0 text-center"><?= get_sub_field('content'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

