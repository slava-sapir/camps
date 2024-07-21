<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Forest_Cliff_Camps
 */

get_header();
?>

	<main id="primary" class="site-main">
        <?php
        get_template_part('template-parts/hero');
        ?>

        <div class="container py-100">
            <?php
            if ( have_posts() ) :
                $categories = get_categories();
            ?>
                <div class="d-md-flex justify-content-md-center align-items-md-center pb-40">
                    <p class="fw-bold mb-0 me-10">Filter articles by:</p>
                    <ul class="list-unstyled d-flex align-items-center flex-wrap mb-0">
                        <?php foreach ($categories as $category) : ?>
                            <?php
                            $category_link = get_category_link($category->term_id);
                            $active_class = (get_query_var('cat') == $category->term_id) ? 'active-cat' : '';
                            ?>
                            <li class="<?php echo $active_class; ?> py-10">
                                <a href="<?php echo esc_url($category_link); ?>"
                                   class="bg-tan py-5 px-15 rounded-pill me-10">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="row gx-md-50 gy-50 justify-content-center">
                    <?php

                    /* Start the Loop */
                    while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/blog-card' );

                    endwhile;
                    ?>
                </div>
                <div id="loading-spinner" style="display: none;">
                    <div class="d-flex justify-content-center mt-50">
                        <div class="spinner-grow text-green" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            <?php
            else :
            get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
