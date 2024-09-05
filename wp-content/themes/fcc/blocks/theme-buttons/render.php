<?php
/**
 * Theme Buttons Block Template.
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

<div id="<?= $anchor; ?>" class="theme-buttons d-flex flex-wrap <?= get_field('button_positioning'); ?> <?= $classes; ?>" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <?php if(have_rows('buttons')): ?>
    <?php while(have_rows('buttons')): the_row(); ?>
            <a href="<?= get_sub_field('button')['url']; ?>" target="<?= get_sub_field('button')['target']; ?>" class="mx-10 btn <?= get_sub_field('button_colour'); ?>"><?= get_sub_field('button')['title']; ?></a>
    <?php endwhile; endif; ?>
</div>