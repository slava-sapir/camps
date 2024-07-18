<?php
/**
 * Template part for displaying the hero
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shed_village
 */

 if (isset($args['query'])) :
    $query = $args['query'];
 endif;

 if ( $query->have_posts() ) : 
 $i = 1;
 ?> 
<div id="faq-accordion" class="accordion">
    <?php while ( $query->have_posts() ) : $query->the_post();
        ?>
        <div class="accordion-item mb-20">
            <h3 class="fs-5 accordion-header" id="heading-<?= $i; ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $i; ?>" aria-expanded="true" aria-controls="collapse-<?= $i; ?>">
                    <?php the_title(); ?>
                </button>
            </h3>
            <div id="collapse-<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                <div class="accordion-body">
                    <?php the_content(); ?>
                    <div class="row align-items-center">
                        <?php 
                        if(!get_field('hide_images')) :
                            if(get_field('add_custom_images')) : 
                                while(have_rows('custom_images')) : the_row(); ?>
                                    <div class="col-4">
                                        <?= wp_get_attachment_image( get_sub_field('image')['id'], 'full', false, ['class' => 'img-fluid'] ); ?>
                                    </div>
                                <?php endwhile;
                            else :  
                                while(have_rows('default_images', 'options')) : the_row(); ?>
                                <div class="col-4">
                                    <?= wp_get_attachment_image( get_sub_field('image')['id'], 'full', false, ['class' => 'img-fluid rounded'] ); ?>
                                </div>
                                <?php endwhile; 
                            endif;
                        endif; ?> 
                    </div>
                </div>
            </div>
        </div>
        <?php
    $i++;
    endwhile;
    wp_reset_postdata(); ?>
    </div>
<?php else :
    echo '<p>No FAQs found in this category.</p>';
endif;