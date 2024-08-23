<?php
/**
 * Experience Carousel Block Template.
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

<section id="experience-carousel">
<?php 
  $id = get_the_ID();
  $theme_color = get_field('theme_colour', $id);
?>
<?php 
  if($theme_color != 'green-theme') : ?>
  <img src="<?= esc_url(get_template_directory_uri() . '/resources/images/main-theme/shapes/white-top-splash.png'); ?>" alt="white-top-splash" class="img-fluid w-100 mt-n1">
<?php endif; ?>

    <div class="hp-1400 hp-sm-1000 hp-md-1200 hp-xl-800 position-relative">

      <div class="d-flex flex-column-reverse flex-xl-row align-items-center">

        <div class="d-flex align-item-center justify-content-center w-100 w-xl-50 border-bottom border-1 <?= $theme_color == 'green-theme' ? 'border-grey600' : 'border-white' ?>">
            <div class="d-flex flex-column gap-30 gap-md-80">
             <h2 class="text-center <?= $theme_color == 'green-theme' ? 'text-grey600' : 'text-white '; ?>"><?= get_field('main_title'); ?></h2>
              <div class="nav nav-tabs d-flex flex-column flex-sm-row justify-content-end align-items-center gap-5 gap-md-20" id="nav-tab" role="tablist">
                    <?php
                    $count = 0;
                    if(have_rows('experience_repeater')):
                     while(have_rows('experience_repeater')): the_row(); 
                     $big_icon = get_sub_field('big_icon');
                     $small_icon = get_sub_field('small_icon');
                     $experience_title = get_sub_field('experience__title');
                     $index = get_row_index();
                     $count++;
                    ?>
                      <a href="javascript:void(0);" role="presentation" class="presentation hp-171 nav-link d-flex justify-content-center align-items-end position-relative <?= $count == 1 ? 'active' : ''; ?>"
                            id="nav-<?php echo $index; ?>-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-<?php echo $index; ?>"
                            type="button"
                            role="tab"
                            aria-controls="nav-<?php echo $index; ?>"
                            aria-selected="false">
                            <div class="click-event mb-n16 flex-column justify-content-center align-items-center <?= $count == 1 ? 'd-flex' : 'd-none'; ?>">
                                <div class="bordered-big-icon p-20 border border-2 <?= $theme_color == 'green-theme' ? 'border-grey600' : 'border-white '; ?> rounded-circle d-flex align-items-center justify-content-center">
                                    <?= wp_get_attachment_image( $big_icon['id'], 'full', false, ['class' => 'img-fluid'] ); ?>
                                </div>
                                <div class="fs-6 fw-semibold <?= $theme_color == 'green-theme' ? 'text-grey600' : 'text-white '; ?> txt pt-10 pb-5"><?= $experience_title ?></div>
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                  <div class="wp-2 hp-20 <?= $theme_color == 'green-theme' ? 'bg-grey600' : 'bg-white '; ?>"></div> 
                                  <div class="bordered-ball border border-2 <?= $theme_color == 'green-theme' ? 'border-grey600' : 'border-white '; ?> rounded-circle d-flex align-items-center justify-content-center wp-20 hp-20">
                                    <div class="<?= $theme_color == 'green-theme' ? 'bg-grey600' : 'bg-white '; ?> rounded-circle wp-10 hp-10"></div>
                                  </div>
                                </div>
                            </div>
                            <div class="hover-event mb-n12 d-flex flex-column gap-10 justify-content-center align-items-center <?= $count == 1 ? 'd-none' : 'd-flex'; ?>">
                                <?= wp_get_attachment_image( $small_icon['id'], 'full', false, ['class' => 'img-fluid small-icon'] ); ?>
                                <p class="fs-6 fw-semibold text-white txt <?= $theme_color == 'green-theme' ? 'text-grey600' : 'text-white '; ?>"><?= $experience_title ?></p>
                                <div class="ball <?= $theme_color == 'green-theme' ? 'bg-grey600' : 'bg-white '; ?> rounded-circle wp-10 hp-10"></div>
                            </div>
                      </a>
                
                    <?php endwhile; endif; ?>
              </div>
            </div>
        </div>

        <div class="tab-content w-100 w-xl-50 ms-0 ms-xl-n50 d-flex align-items-center justify-content-center justify-content-xl-start ">
              <?php
                $count = 0;
                if(have_rows('experience_repeater')):
                while(have_rows('experience_repeater')): the_row(); 
                  $experience_image = get_sub_field('experience_image');
                  $yellow_icon = get_sub_field('yellow_icon');
                  $experience_title = get_sub_field('experience__title');
                  $experience_text = get_sub_field('experience_text');
                  $index = get_row_index();
                  $count++;
              ?>

              <div class="tab-pane fade <?php echo $count === 1 ? 'show active' : ''; ?>" id="nav-<?php echo $index; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $index; ?>-tab" tabindex="0">
                <div class="rounded-container d-flex flex-column bg-white rounded-circle border-20 border border-white wp-420 wp-md-520 wp-lg-671 hp-420 hp-md-520 hp-lg-671" >
                  <?= wp_get_attachment_image( $experience_image['id'], 'circled-image', false, ['class' => 'img-fluid rounded-top-5'] ); ?>
                  <div class="d-flex flex-column gap-5 justify-content-center align-items-center">
                    <div class=" mt-n30 bg-white rounded-circle p-10">
                    <?= wp_get_attachment_image( $yellow_icon['id'], 'full', false, ['class' => 'img-fluid'] ); ?>
                    </div>
                    <p class="fs-4 fw-normal text-grey600 m-0"><?php echo $experience_title; ?></p>
                    <p class="fs-6 fw-normal w-75 text-grey600 text-center m-0 d-none d-md-block"><?php echo $experience_text; ?></p>
                  </div>
                </div>
              </div>
          <?php endwhile; endif; ?>
        </div>

      </div>

      <?php 
       if($theme_color != 'green-theme') : ?>
      <img src="<?= esc_url(get_template_directory_uri() . '/resources/images/main-theme/shapes/white-top-splash.png'); ?>" alt="white-top-splash-rotate" class="img-fluid w-100 position-absolute start-0 bottom-0 transform-rotateY-rotateX mb-n1">
      <?php endif; ?>
     
    </div>

</section>

<!-- <script>
  if (typeof jQuery !== 'undefined') {
    console.log('jQuery is loaded!');
  } else {
    console.log('jQuery is not loaded.');
  }
</script> -->
