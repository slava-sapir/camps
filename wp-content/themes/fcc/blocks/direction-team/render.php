<?php
/**
 * Direction Team Block.
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


if(have_rows('direction_team')) :
?>
<section id="direction-team" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container">
        <?php if(get_field('title')) : ?>
            <h2 class="text-center px-md-50 px-lg-125"><?= get_field('title'); ?></h2>
            <div class="text-center pb-20">
                <svg width="106" height="15" viewBox="0 0 106 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.59699 14.3199C39.2294 12.0627 70.597 10.4252 99.4285 9.31871C101.475 6.79598 103.388 4.14047 105.079 1.4407C91.2418 0.422752 56.5372 -1.25907 0.920837 1.52922C3.101 6.3534 6.03754 10.6022 9.59699 14.3199Z" fill="#6BDE46"/>
                </svg>
            </div>
        <?php endif; ?>
        <div class="row gx-sm-20 py-40">
            <?php while(have_rows('direction_team')) : the_row(); 
            $image = get_sub_field('image');
            $name = get_sub_field('name');
            $position = get_sub_field('position');
            $bio = get_sub_field('bio'); ?>
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="team-card d-flex align-self-stretch flex-column w-100 justify-content-between position-relative">
                    <div class="team-member-image position-relative rounded">
                        <?= wp_get_attachment_image( $image['id'], 'full', false, ['class' => 'img-fluid rounded position-relative',] ); ?>
                    </div>
                    <div class="pt-20">
                        <h3 class="h5 mb-10"><?= $name; ?></h3>
                        <p class="fw-bold mb-10"><?= $position; ?></p>
                        <a href="javascript:void(0)" class="stretched-link" data-bs-toggle="modal" data-bs-target="#team_member_<?= get_row_index(); ?>" title="<?= $name; ?>"></a>
                        <hr class="border border-grey300 border-5 rounded">
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>

    <?php while(have_rows('direction_team')) : the_row(); 
    $image = get_sub_field('image');
    $name = get_sub_field('name');
    $position = get_sub_field('position');
    $bio = get_sub_field('bio'); ?>
        <div class="modal fade team-member-bio" id="team_member_<?= get_row_index(); ?>" tabindex="-1" aria-labelledby="team-member-name-<?= get_row_index(); ?>" aria-hidden="true">
            <div class="modal-dialog modal-max modal-dialog-centered">
                    <div class="modal-content border-0 rounded w-100 pt-sm-50 px-sm-50">
                        <div class="container-fluid">
                            <div class="row gx-lg-50">
                                <div class="col-lg-4 pt-lg-70 pt-xl-0">
                                    <button type="button" class="btn-close d-block d-lg-none ms-auto bg-white border-0 mb-20" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18.3002 5.70996C18.1134 5.5227 17.8597 5.41747 17.5952 5.41747C17.3307 5.41747 17.077 5.5227 16.8902 5.70996L12.0002 10.59L7.11021 5.69996C6.92338 5.5127 6.66973 5.40747 6.40521 5.40747C6.1407 5.40747 5.88705 5.5127 5.70021 5.69996C5.31021 6.08996 5.31021 6.71996 5.70021 7.10996L10.5902 12L5.70021 16.89C5.31021 17.28 5.31021 17.91 5.70021 18.3C6.09021 18.69 6.72021 18.69 7.11021 18.3L12.0002 13.41L16.8902 18.3C17.2802 18.69 17.9102 18.69 18.3002 18.3C18.6902 17.91 18.6902 17.28 18.3002 16.89L13.4102 12L18.3002 7.10996C18.6802 6.72996 18.6802 6.08996 18.3002 5.70996Z" fill="#6BDE46"/></svg></button>
                                    <?= wp_get_attachment_image( $image['id'], 'full', false, ['class' => 'img-fluid rounded position-relative rounded-bottom-xxl-0',] ); ?>
                                </div>
                                <div class="col-lg-8">
                                    <button type="button" class="btn-close d-none d-lg-block ms-auto bg-white border-0" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18.3002 5.70996C18.1134 5.5227 17.8597 5.41747 17.5952 5.41747C17.3307 5.41747 17.077 5.5227 16.8902 5.70996L12.0002 10.59L7.11021 5.69996C6.92338 5.5127 6.66973 5.40747 6.40521 5.40747C6.1407 5.40747 5.88705 5.5127 5.70021 5.69996C5.31021 6.08996 5.31021 6.71996 5.70021 7.10996L10.5902 12L5.70021 16.89C5.31021 17.28 5.31021 17.91 5.70021 18.3C6.09021 18.69 6.72021 18.69 7.11021 18.3L12.0002 13.41L16.8902 18.3C17.2802 18.69 17.9102 18.69 18.3002 18.3C18.6902 17.91 18.6902 17.28 18.3002 16.89L13.4102 12L18.3002 7.10996C18.6802 6.72996 18.6802 6.08996 18.3002 5.70996Z" fill="#6BDE46"/></svg></button>
                                    <div class="pt-20 pt-lg-50">
                                        <h3 class="h4 fw-bold mb-0"><?= $name; ?></h3>
                                        <p class="fs-5 fw-bold"><?= $position; ?></p>
                                        <div class="pb-sm-30 pb-lg-0"><?= $bio; ?></div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <?php endwhile; ?>
</section>
<?php endif; ?>