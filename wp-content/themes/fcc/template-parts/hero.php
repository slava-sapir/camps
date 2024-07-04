<?php
/**
 * Template part for displaying the hero
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shed_village
 */


 ?>
 <section id="hero" class="position-relative" style="background-image: url(<?= get_field('hero_image')['url']; ?>);" role="image" aria-label="<?= get_field('hero_image')['alt']; ?>">
    <div class="custom-container">
        <?php if(get_field('hero_text')) : ?>
        <div class="hero-text text-cloud <?= get_field('text_position'); ?>">
            <?= get_field('hero_text'); ?>
        </div>
        <?php endif;
        if(get_field('hero_cta')) : ?>
        <div class="btn-wrapper pt-30 text-center">
            <a href="<?= get_field('hero_cta')['url']; ?>" class="custom-btn-white" target="<?= get_field('hero_cta')['target']; ?>"><?= get_field('hero_cta')['title']; ?></a>
        </div>
        <?php endif; ?>
    </div>
    <img src="<?= get_template_directory_uri(); ?>/resources/images/main-theme/shapes/curve-trees-white-hero.svg" alt="" class="position-absolute img-fluid bottom-0 end-0">
 </section>