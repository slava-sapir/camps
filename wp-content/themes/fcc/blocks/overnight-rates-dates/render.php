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

<section id="<?= $anchor; ?>" class="overnight-rates-dates <?= $classes; ?>"
         style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container">
        <div class="nav nav-tabs row d-flex flex-column flex-sm-row gx-5" id="nav-tab" role="tablist">
            <?php
            while (have_rows('cities')): the_row();
                $camp = get_sub_field('camp_name');
                $ages = get_sub_field('camp_ages');
                $index = get_row_index();
                ?>

                <div class="col d-flex pb-10 pb-sm-0">
                    <a href="javascript:void(0);"
                       class="p-20 rounded-1 border border-3 border-<?= $accent_color; ?> d-flex w-100 align-self-stretch flex-column justify-content-center align-items-center <?= $index == 1 ? 'active' : ''; ?>"
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
                $camp = get_sub_field('camp_name');
                $index = get_row_index();
                ?>

                <div class="tab-pane fade <?= $index === 1 ? 'show active' : ''; ?>"
                     id="nav-<?= $index; ?>"
                     role="tabpanel"
                     aria-labelledby="nav-<?= $index; ?>-tab"
                     tabindex="0">
                    <p class="text-center my-20"><?= get_sub_field('text'); ?></p>

                    <?php if (have_rows('rate_dates')): ?>
                        <div class="camp-grid align-items-center overflow-x-auto">
                            <!-- First row: Camp Dates label as the first column -->
                            <div class="camp-label d-flex align-self-stretch fw-bold align-items-center justify-content-center bg-grey100 py-40 px-10 text-center rounded-1">
                                <small><?= $camp; ?> Dates</small>
                            </div>

                            <?php
                            $previous_rate = null;
                            $col_span = 1; // Tracks how many columns to span

                            while (have_rows('rate_dates')) : the_row();
                                $dates = get_sub_field('dates');
                                $rate = get_sub_field('rate');

                                // Output the date for every row
                                echo "<div class='dates rounded-1 bg-grey100 d-flex align-self-stretch align-items-center justify-content-center'>{$dates}</div>";

                                // Check if the rate has changed
                                if ($previous_rate && $rate !== $previous_rate) {
                                    // Output the previous rate and its column span
                                    echo "<div class='rate fw-bold text-center bg-grey100 rounded-1 d-flex align-self-stretch align-items-center justify-content-center' style='grid-column: span {$col_span};'>{$previous_rate}</div>";
                                    $col_span = 1; // Reset col_span
                                }

                                // Increment col_span if the rate stays the same
                                if ($rate === $previous_rate) {
                                    $col_span++;
                                } else {
                                    $previous_rate = $rate; // Set new rate
                                }

                            endwhile; ?>

                            <!-- Second row: Rates label as the first column -->
                            <div class="rate-label d-flex align-self-stretch fw-bold align-items-center justify-content-center bg-grey100 rounded-1 py-40 px-10">
                                <small>Rates</small>
                            </div>
                            <?php echo "<div class='rate fw-bold text-center bg-grey100 rounded-1 d-flex align-self-stretch align-items-center justify-content-center' style='grid-column: span {$col_span};'>{$previous_rate}</div>";
                            ?>


                        </div>
                        <div class="d-lg-none">
                            <div class="row gx-10 mb-10">
                                <div class="col-6">
                                    <div class="camp-label d-flex align-self-stretch fw-bold align-items-center justify-content-center bg-grey100 py-40 px-10 text-center rounded-1">
                                        <small><?= $camp; ?> Dates</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rate-label d-flex align-self-stretch fw-bold align-items-center justify-content-center bg-grey100 rounded-1 py-40 px-10">
                                        <small>Rates</small>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper rates-dates-swiper">
                                <div class="swiper-wrapper">
                                    <?php while (have_rows('rate_dates')): the_row();
                                        $dates = get_sub_field('dates');
                                        $rate = get_sub_field('rate');?>
                                        <div class="swiper-slide">
                                            <div class="row gx-10">
                                                <div class="col-6 d-flex">
                                                    <div class='dates rounded-1 bg-grey100 d-flex w-100 align-self-stretch align-items-center justify-content-center py-40 px-10'><?= $dates; ?></div>
                                                </div>
                                                <div class="col-6 d-flex">
                                                    <div class='rate fw-bold text-center bg-grey100 rounded-1 d-flex w-100 align-self-stretch align-items-center justify-content-center'><?= $rate; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            <?php endwhile ?>
        </div>

        <?php
        $register_link = get_field('register_link');
        if ($register_link) :
            ?>
            <div class="d-flex justify-content-center pt-40">
                <a href="<?= $register_link['url']; ?>" target="<?= $register_link['target']; ?>" class="btn
            <?= $theme_color === 'gold-theme' ? 'btn-gold' : ($theme_color === 'green-theme' ? 'btn-green' : 'btn-teal'); ?> 
           "><?= $register_link['title']; ?>
                </a>
            </div>
        <?php endif; ?>


    </div>
</section>
