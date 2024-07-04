<?php
/**
 * The template for displaying front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Forest_Cliff_Camps
 */

get_header();
?>

    <main id="primary" class="site-main">

    <?php get_template_part('template-parts/hero'); 
    the_content(); ?>

    </main><!-- #main -->

<?php
get_footer();
