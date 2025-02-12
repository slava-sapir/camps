<?php
/**
 * FAQs Block Template.
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
$categories = get_terms( array(
    'taxonomy' => 'faq_category',
    'hide_empty' => false,
));
$displayed_category = get_field('displayed_category');
$link = get_field('link');
global $theme_color;
?>

<section id="faqs-no-search" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="small-container">
        <h2 class="text-center px-md-50 px-lg-125"><?= get_field('title'); ?></h2>
        <div class="text-center">
            <svg width="106" height="15" viewBox="0 0 106 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.59699 14.3199C39.2294 12.0627 70.597 10.4252 99.4285 9.31871C101.475 6.79598 103.388 4.14047 105.079 1.4407C91.2418 0.422752 56.5372 -1.25907 0.920837 1.52922C3.101 6.3534 6.03754 10.6022 9.59699 14.3199Z" fill="<?= get_field('underline_icon_color'); ?>"/>
            </svg>
        </div>

        <div class="mt-10">
            <!-- FAQ Accordion -->
            <?php
            // Get posts from the selected category
            if ( $displayed_category ) :
                $i = 1;
                $query = new WP_Query( array(
                    'post_type' => 'faq',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'faq_category',
                            'field'    => 'term_id',
                            'terms'    => $displayed_category,
                        ),
                    ),
                ));

                get_template_part('template-parts/faq-accordion', null, array('query' => $query));
            endif; ?>
        </div>

        <?php
        $theme_colors = [
            'gold-theme' => 'btn-gold',
            'green-theme' => 'btn-green',
            'teal-theme' => 'btn-teal',
        ];
        $theme_class = isset($theme_colors[$theme_color]) ? $theme_colors[$theme_color] : ''; ?>

        <?php if ($link): ?>
            <div class="text-center">
                <a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>" class="btn <?= $theme_class ?> mx-10"><?= $link['title']; ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>