<?php
/* Template Name: Policies */
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
                    <span><?php the_title(); ?></span>
                </div>

                <h1 class="h2"><?php the_title(); ?></h1>
                <?php
                the_content();

            endwhile; // End of the loop.
            ?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
