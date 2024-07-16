<?php
/**
 * Board of Directors Block Template.
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

<section id="board-of-directors" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;<?= get_field('add_tan_background') ? ' background-color: #f2efeb;"' : ''; ?>">
    <div class="container">
        <h2 class="text-center"><?= get_field('heading'); ?></h2>
        <div class="text-center">
            <svg width="106" height="15" viewBox="0 0 106 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.59699 14.3199C39.2294 12.0627 70.597 10.4252 99.4285 9.31871C101.475 6.79598 103.388 4.14047 105.079 1.4407C91.2418 0.422752 56.5372 -1.25907 0.920837 1.52922C3.101 6.3534 6.03754 10.6022 9.59699 14.3199Z" fill="#6BDE46"/>
            </svg>
        </div>
        <p class="text-center fs-5 mt-20"><?= get_field('content'); ?></p>
        <?php if(have_rows('mandates')) : ?>
            <div class="row gy-20">
                <?php while(have_rows('mandates')) : the_row(); ?>
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="mandate p-20 d-flex align-self-stretch w-100 justify-content-center align-items-center bg-white rounded tile-shadow">
                            <p class="mb-0 fw-bold text-center"><?= get_sub_field('mandate'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; 
        if(have_rows('board_of_directors')) : ?>
            <div class="row gy-40 pt-40">
                <?php while(have_rows('board_of_directors')) : the_row(); ?>
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="director d-flex flex-column align-self-stretch w-100">
                            <h3 class="h5 mb-10"><?= get_sub_field('name'); ?></h3>
                            <p class="fw-bold mb-10"><?= get_sub_field('position') ?></p>
                            <hr class="border border-grey300 border-3 rounded m-0">
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php endif; ?>
    </div>
</section>