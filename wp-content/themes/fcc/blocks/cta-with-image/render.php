<?php
/**
 * Page Intro Block Template.
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

<section id="cta-with-image" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;<?= get_field('add_tan_background') ? ' background-color: #f2efeb;"' : ''; ?>">
    <div class="container container-ed">
        <?= wp_get_attachment_image( get_field('image')['id'], 'full', false, ['class' => 'img-fluid rounded'] ); 
        if(get_field('heading') || get_field('content') || get_field('cta')) : ?>
            <div class="text-block bg-white p-50 rounded tile-shadow mx-auto">
                <?php if(get_field('heading')) : ?>
                    <h2 class="text-center"><?= get_field('heading'); ?></h2>
                    <div class="text-center">
                        <svg width="106" height="15" viewBox="0 0 106 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.59699 14.3199C39.2294 12.0627 70.597 10.4252 99.4285 9.31871C101.475 6.79598 103.388 4.14047 105.079 1.4407C91.2418 0.422752 56.5372 -1.25907 0.920837 1.52922C3.101 6.3534 6.03754 10.6022 9.59699 14.3199Z" fill="#6BDE46"/>
                        </svg>
                    </div>
                <?php endif;
                if(get_field('content')) : ?>
                    <p class="text-center fs-5 mt-20"><?= get_field('content'); ?></p>
                <?php endif; 
                if(get_field('cta')) : ?>
                    <div class="btn-wrapper d-flex justify-content-center">
                            <a href="<?= get_field('cta')['url']; ?>" target="<?= get_field('cta')['target']; ?>" class="btn btn-green"><?= get_field('cta')['title']; ?></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>