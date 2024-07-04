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
                <?php while($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="blog-card rounded overflow-hidden tile-shadow w-100 d-flex align-self-stretch flex-column justify-content-between">
                            <div>
                                <div class="blog-thumb">
                                    <?= get_the_post_thumbnail(get_the_id(), 'blog-thumb', ['class' => 'img-fluid w-100']); ?>
                                </div>
                                <div class="blog-info px-20 pt-20">
                                    <div class="d-flex flex-wrap">
                                        <div class="blog-date border border-green rounded-pill d-flex align-items-center px-15 py-5 me-5 mb-20">
                                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.66667 7.4729H6V8.80623H4.66667V7.4729ZM4.66667 10.1396H6V11.4729H4.66667V10.1396ZM7.33333 7.4729H8.66667V8.80623H7.33333V7.4729ZM7.33333 10.1396H8.66667V11.4729H7.33333V10.1396ZM10 7.4729H11.3333V8.80623H10V7.4729ZM10 10.1396H11.3333V11.4729H10V10.1396Z" fill="#6BDE46"/><path d="M3.33333 14.8062H12.6667C13.402 14.8062 14 14.2082 14 13.4729V4.13957C14 3.40423 13.402 2.80623 12.6667 2.80623H11.3333V1.4729H10V2.80623H6V1.4729H4.66667V2.80623H3.33333C2.598 2.80623 2 3.40423 2 4.13957V13.4729C2 14.2082 2.598 14.8062 3.33333 14.8062ZM12.6667 5.4729L12.6673 13.4729H3.33333V5.4729H12.6667Z" fill="#6BDE46"/></svg>
                                            <small class="ms-5"><?= get_the_date('M j, Y'); ?></small>
                                        </div>
                                        <?php 
                                        $categories = get_the_category();
                                        foreach($categories as $category) :
                                            $cat_name = $category->name; ?>
                                            <div class="category-pill bg-tan py-5 px-15 rounded-pill me-5 mb-20">
                                                <small><?= $cat_name; ?></small>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <h3 class="h5 fw-bold"><?= get_the_title(); ?></h3>
                                    <p><?= get_the_excerpt(); ?></p>
                                    
                                </div>
                            </div>
                            <div class="author-info px-20 pb-20">
                            Written by <?= get_the_author() ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>