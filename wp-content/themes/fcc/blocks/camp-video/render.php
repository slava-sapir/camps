<?php
/**
 * Camp Video Block Template.
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
$background = get_field('background');
?>

<section id="<?= esc_attr($anchor) ?>" class="<?= $background; ?>" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;<?= get_field('add_background_colour') ? ' background-color: #f2efeb;"' : ''; ?>">
    <div class="container">
        <div class="ratio ratio-16x9 <?= esc_attr($classes) ?>">
            <?= get_field('youtube_link'); ?>
        </div>
    </div>
</section>