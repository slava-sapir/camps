<?php
/**
 * Experience Block Template.
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
$anchor = isset($block['anchor']) ? $block['anchor'] : '';
$classes = isset($block['className']) ? $block['className'] : '';

?>

<section id="<?= esc_attr($anchor) ?>" class="experience-cards <?= esc_attr($classes) ?>"
         style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container">
        <div class="row gx-md-50 gy-50">
            <?php while (have_rows('cards')) :
                the_row(); ?>
                <div class="col-md-6">
                    <div class="experience-card position-relative">
                        <div class="experience-image position-relative rounded mb-20">
                            <?= wp_get_attachment_image(get_sub_field('image')['ID'], 'experience-thumb', false, ['class' => 'position-relative img-fluid rounded shadow']); ?>
                        </div>
                        <?php if (get_sub_field('link')) : ?>
                            <h3 class="h6 fw-bold <?= 'hover-' . get_sub_field('hover_colour'); ?> mb-10 px-10 text-center"><?= get_sub_field('link')['title']; ?></h3>
                            <a href="<?= get_sub_field('link')['url']; ?>"
                               target="<?= get_sub_field('link')['target']; ?>"
                               class="stretched-link" title="<?= get_sub_field('link')['title']; ?>"></a>
                        <?php endif; ?>
                        <hr class="border border-grey300 border-3 rounded <?= 'hover-' . get_sub_field('hover_colour'); ?>">
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>