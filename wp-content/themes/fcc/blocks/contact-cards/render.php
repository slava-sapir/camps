<?php
/**
 * Contact Cards Block Template.
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

<?php if(have_rows('contact_cards')) : ?>
<section id="contact-cards">
    <div class="container" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
        <div class="row gy-20">
            <?php while(have_rows('contact_cards')) : the_row();
            $slug = get_sub_field('camp');
            $content = get_sub_field('text_content');
            ?>
            <div class="col-lg-6 d-flex">
                <div class="camp-card rounded <?= $slug; ?> d-flex flex-column align-self-stretch w-100 px-40 py-20 text-white">
                    <?= $content ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>