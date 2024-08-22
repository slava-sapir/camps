<?php
/**
 * Rates & Dates Block Template.
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

<section id="locations">

 <img src="<?= esc_url(get_template_directory_uri() . '/resources/images/day-camp-theme/shapes/splash-white-top.svg'); ?>" alt="white-top-splash" class="img-fluid w-100 mb-n300">

    <div class="container">

        <div class="position-relative z-1">
        <?php 
        $locatiions_map = get_field('locations_map');
        echo $locatiions_map;
        ?>
        </div>
        
    </div>

 <img src="<?= esc_url(get_template_directory_uri() . '/resources/images/day-camp-theme/shapes/splash-white-bottom.svg'); ?>" alt="white-top-splash" class="img-fluid w-100 mt-n300">

</section>