<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Forest_Cliff_Camps
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="blog-container py-100">
            <?php
            while (have_posts()) :
                the_post(); ?>
                <div class="breadcrumbs d-flex align-items-center pb-20">
                    <a href="<?= get_home_url(); ?>">Home</a>
                    <span class="px-10">&gt;</span>
                    <a href="/blog">Blog</a>
                    <span class="px-10">&gt;</span>
                    <span><?php the_title(); ?></span>
                </div>

                <h1 class="h4"><?php the_title(); ?></h1>
                <div class="pb-20">
                    <?php get_template_part('template-parts/author-info'); ?>
                </div>
                <?php
                the_content();

            endwhile; // End of the loop.
            ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
