<?php
/**
 * Latest Blogs Block Template.
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

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 3
];

$query = new WP_Query($args);
if($query->have_posts()) : ?>
    <section id="latest-blog">
        <div class="container" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
            <?php if(get_field('section_heading')) : ?>
                <h2 class="text-center"><?= get_field('section_heading'); ?></h2>
                <div class="text-center pb-20">
                    <svg width="106" height="15" viewBox="0 0 106 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.59699 14.3199C39.2294 12.0627 70.597 10.4252 99.4285 9.31871C101.475 6.79598 103.388 4.14047 105.079 1.4407C91.2418 0.422752 56.5372 -1.25907 0.920837 1.52922C3.101 6.3534 6.03754 10.6022 9.59699 14.3199Z" fill="#6BDE46"/>
                    </svg>
                </div>
            <?php endif; ?>
            <div class="row gx-md-50 gy-50 justify-content-center">
                <?php while($query->have_posts()) : $query->the_post();
                    get_template_part('template-parts/blog-card');
                 endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="text-center pt-20"><a href="/blog" class="btn btn-white">View Our Blog</a></div>
        </div>
    </section>
<?php endif; ?>