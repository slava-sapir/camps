<?php
/**
 * Call-to-Action Block Template.
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
?>

<section id="call-to-action" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;<?= get_field('add_background_colour') ? ' background-color: #f2efeb;"' : ''; ?>">
    <div class="small-container">
        <?php if (get_field('text_content')) : 
            echo get_field('text_content'); 
        endif; 
        if(get_field('cta_1') || get_field('cta_2')) : ?>
            <div class="d-flex justify-content-center">
                <?php if(get_field('cta_1')) : ?>
                    <a href="<?= get_field('cta_1')['url']; ?>" target="<?= get_field('cta_1')['target']; ?>" class="btn btn-green mx-10"><?= get_field('cta_1')['title']; ?></a>
                <?php endif;
                if(get_field('cta_2')) : ?>
                    <a href="<?= get_field('cta_2')['url']; ?>" target="<?= get_field('cta_2')['target']; ?>" class="btn btn-white mx-10"><?= get_field('cta_2')['title']; ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>