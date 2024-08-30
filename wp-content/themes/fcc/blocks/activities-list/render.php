<?php
/**
 * Activities List Block Template.
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

global $theme_color;

// Get the selected category from the ACF field
$selected_category = get_field('activities');

// Prepare query arguments
$args = array(
    'post_type' => 'activity',  // Custom post type name
    'posts_per_page' => -1,
    'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'activity_category', // Custom taxonomy name
            'field' => 'slug',
            'terms' => $selected_category,
        ),
    ),
);

// Execute the query
$activities_query = new WP_Query($args);

?>

<section id="activities-list" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <?php if ($activities_query->have_posts()) : ?>
        <div class="container">
                <ul class="nav nav-pills justify-content-center" id="activitiesTabs" role="tablist">
                <?php 
                $is_first = true;
                while ($activities_query->have_posts()) : $activities_query->the_post(); 
                $activity_logo = get_field('activity_logo', get_the_ID());
                ?>
                    <li class="nav-item m-5" role="presentation">
                        <a class="nav-link bg-tan fs-6 <?= $is_first ? 'active' : '' ?>" id="tab-<?= get_the_ID(); ?>" data-bs-toggle="tab" href="#content-<?= get_the_ID(); ?>" role="tab" aria-controls="content-<?= get_the_ID(); ?>" aria-selected="<?= $is_first ? 'true' : 'false' ?>">
                            <?= wp_get_attachment_image($activity_logo, 'full', false,  array('class' => 'img-fluid')); ?>
                            <small class="fw-bold"><?php the_title(); ?></small>
                        </a>
                    </li>
                <?php 
                $is_first = false; 
                endwhile; 
                ?>
            </ul>
        </div>
        
        <div class="tab-content" id="activitiesTabContent">
            <?php 
            $is_first = true;
            while ($activities_query->have_posts()) : $activities_query->the_post(); 
            ?>
                <div class="tab-pane container fade <?= $is_first ? 'show active' : '' ?>" id="content-<?= get_the_ID(); ?>" role="tabpanel" aria-labelledby="tab-<?= get_the_ID(); ?>">
                    <div class="row align-items-center my-20">
                        <div class="col-lg-8 order-lg-2">
                            <div class="image-block ms-lg-n80">
                                <?php the_post_thumbnail('full', ['class' => 'img-fluid', 'style' => 'border-radius: 8px;']); ?> 
                            </div>
                        </div>
                        <div class="col-lg-4 order-lg-1 mt-10">
                            <div class="text-block p-40 bg-white tile-shadow rounded z-1 position-relative">
                                <span class="fw-bold fs-3 fst-italic"><?php the_title(); ?></span>
                                <div class="mt-10"><?php the_content(); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            $is_first = false; 
            endwhile; 
            ?>
        </div>
    <?php else : ?>
        <p>No activities found for this category.</p>
    <?php endif; ?>

    <?php wp_reset_postdata(); // Restore original Post Data ?>
</section>
