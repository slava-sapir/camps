<?php
/**
 * Camp Cards Block Template.
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

<?php if(have_rows('camp_cards')) : ?>
<section id="camp-cards">
    <div class="container" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
        <div class="row justify-content-center gy-50 gx-sm-50">
            <?php while(have_rows('camp_cards')) : the_row();
            $title = 'Day Camps';
            $slug = 'day-camps';
            $color = 'gold';
            if(get_sub_field('camp') === 'overnight-camp') :
                $title = 'Overnight Camps';
                $slug = 'overnight-camps';
                $color = 'teal';
            elseif(get_sub_field('camp') === 'school-groups') :
                $title = 'Schools + Groups';
                $slug = 'schools-groups';
                $color = 'green';
            endif;
            ?>
            <div class="col-lg-6 d-flex">
                <div class="camp-card <?= $slug; ?> d-flex flex-column align-self-stretch w-100">
                    <?= wp_get_attachment_image( get_sub_field('thumbnail')['id'], 'full', false, ['class' => 'img-fluid text-center'] ); ?>
                    <div class="camp-card-text tile-shadow pt-40 px-20">
                        <h2 class="text-center text-white"><?= $title ?></h2>
                        <div class="text-center"><a href="/<?= $slug; ?>" class="btn btn-<?= $color; ?> stretched-link"> Let's Go!</a></div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>