<?php
/**
 * Two Columns Block Template.
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
$container = get_field('container_size'); ?>


<section id="<?= esc_attr($anchor) ?>" style="padding-top: <?= esc_attr(get_field('padding_top')); ?>px; padding-bottom: <?= esc_attr(get_field('padding_bottom')); ?>px;<?= get_field('add_tan_background') ? ' background-color: #f2efeb;"' : ''; ?>">
    <div class="<?= esc_attr($container) ?>">
            <InnerBlocks class="row gy-50 gx-lg-100" />
    </div>
</section>