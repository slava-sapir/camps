<?php
/**
 * Template part for displaying the hero
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shed_village
 */

$id = get_the_ID();
$title = get_field('hero_title', $id);
$title_spacing = 'pb-100';

if (is_search()) :
    $id = 'options';
    $title = 'Search Results for: ' . get_search_query();
elseif ((is_home() && !is_front_page()) || is_category()) :
    $id = 393;
elseif (get_post_type() === 'faq') :
    $id = is_archive() ? 'options' : 'term_' . get_queried_object()->term_id;
endif;

global $post;
$camp_model = new Camp($post);

if ($camp_model->is_camp_page()) :
    $title_spacing = 'pb-80';
endif;
if(get_field('hero_cta')) :
    $title_spacing = 'pb-40';
endif;
?>
<section id="hero"
         class="position-relative d-flex align-items-end justify-content-center<?= get_field('hero_title', $id) ? ' darken' : ''; ?>"
         style="background: url(<?= get_field('hero_image', $id)['url']; ?>) lightgray 50% / cover no-repeat;"
         role="image" aria-label="<?= get_field('hero_image', $id)['alt']; ?>">
    <div class="small-container">
        <?php if (get_field('hero_title', $id)) : ?>
            <div class="position-relative z-1">
                <h1 class="text-center text-white mb-0 <?= $title_spacing ?>"><?= $title; ?></h1>
            </div>
        <?php endif;
        if (get_field('hero_cta')) : ?>
            <div class="position-relative z-1 pb-10 text-center">
                <a href="<?= get_field('hero_cta', $id)['url']; ?>" class="btn"
                   target="<?= get_field('hero_cta', $id)['target']; ?>"><?= get_field('hero_cta', $id)['title']; ?></a>
            </div>
        <?php endif; ?>
    </div>
    <img src="<?= get_template_directory_uri(); ?>/resources/images/main-theme/shapes/curve-trees-white-hero.svg" alt=""
         class="position-absolute img-fluid bottom-0 end-0">
</section>