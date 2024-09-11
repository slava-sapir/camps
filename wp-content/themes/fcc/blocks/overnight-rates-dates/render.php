<?php
/**
 * Overnight Rates & Dates Block Template.
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
$id = get_the_ID();
global $theme_color;
$accent_color = 'grey100';
if ($theme_color === 'gold-theme') :
    $accent_color = 'tan';
endif;

?>

<section id="<?= $anchor; ?>" class="<?= $classes; ?>"
         style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container">
        <div class="nav nav-tabs row d-flex gx-5" id="nav-tab" role="tablist">
            <?php
            while (have_rows('cities')): the_row();
                $camp = get_sub_field('camp_name');
                $ages = get_sub_field('camp_ages');
                $index = get_row_index();
                ?>

                <div class="col">
                    <a href="javascript:void(0);"
                       class="p-20 rounded-1 border border-3 border-<?= $accent_color; ?> d-flex flex-column justify-content-center align-items-center <?= $index == 1 ? 'active' : ''; ?>"
                       id="nav-<?= $index; ?>-tab"
                       data-bs-toggle="tab"
                       data-bs-target="#nav-<?= $index; ?>"
                       role="tab"
                       aria-controls="nav-<?= $index; ?>"
                       aria-selected="<?= $index == 1 ? 'true' : 'false'; ?>"
                    >
                        <p class="fw-semibold text-center mb-0"><?= $camp; ?></p>
                        <p class="text-center mb-0"><?= $ages; ?></p>
                    </a>
                </div>
            <?php endwhile;
            reset_rows(); ?>
        </div>

        <div class="tab-content">
            <?php
            while (have_rows('cities')): the_row();
                $index = get_row_index();
                ?>

                <div class="tab-pane fade <?= $index === 1 ? 'show active' : ''; ?>"
                     id="nav-<?= $index; ?>"
                     role="tabpanel"
                     aria-labelledby="nav-<?= $index; ?>-tab"
                     tabindex="0">
                    <p class="text-center my-20"><?= get_sub_field('text'); ?></p>

                </div>

            <?php endwhile ?>
        </div>

        <?php
        $register_link = get_field('register_link');
        if ($register_link) :
            ?>
            <div class="d-flex justify-content-center">
                <a href="<?= $register_link['url']; ?>" target="<?= $register_link['target']; ?>" class="btn
            <?= $theme_color === 'gold-theme' ? 'btn-gold' : ($theme_color === 'green-theme' ? 'btn-green' : 'btn-teal'); ?> 
           "><?= $register_link['title']; ?>
                </a>
            </div>
        <?php endif; ?>


    </div>
</section>
