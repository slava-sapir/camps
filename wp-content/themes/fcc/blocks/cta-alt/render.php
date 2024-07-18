<?php
/**
 * Alternative Call-to-Action Block Template.
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
?>

<section id="<?= $anchor; ?>" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="cta-alt p-20 rounded text-white">
        <?php if (get_field('text_content')) : 
            echo get_field('text_content'); 
        endif; 
        if(get_field('cta')) : ?>
            <div class="d-flex justify-content-<?= get_field('button_alignment'); ?>">
                <a href="<?= get_field('cta')['url']; ?>" target="<?= get_field('cta')['target']; ?>" class="btn btn-white"><?= get_field('cta')['title']; ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>