<?php
/**
 * Rates & Dates Block Template.
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

  $id = get_the_ID();
  $theme_color = get_field('theme_colour', $id);
?>

<section id="rates-dates">
    <div class="container position-relative">
                
      <div class="nav nav-tabs gap-5 ms-5" id="nav-tab" role="tablist">
            <?php
            if(have_rows('rates_dates')):
              while(have_rows('rates_dates')): the_row(); 
              $city_name = get_sub_field('city_name');
              $index = get_row_index();
            ?>
            
              <a href="javascript:void(0);" 
                  role="presentation" 
                  class="presentation-tab p-20 rounded-1 border border-3 border-tan d-flex justify-content-center align-items-center <?= $index == 1 ? 'active' : ''; ?>"
                  id="nav-<?php echo $index; ?>-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-<?php echo $index; ?>"
                  role="tab"
                  aria-controls="nav-<?php echo $index; ?>"
                  aria-selected="<?= $index == 1 ? 'true' : 'false'; ?>">
                  <span class="fs-6 fw-semibold text-center"><?php echo $city_name; ?></span>
              </a>
            <?php endwhile; endif; ?>
      </div>

      <div class="tab-content mb-50">
          <?php
            if(have_rows('rates_dates')):
            while(have_rows('rates_dates')): the_row(); 
            $index = get_row_index();
          ?>
            <div class="tab-pane fade <?php echo $index === 1 ? 'show active' : ''; ?>" 
            id="nav-<?php echo $index; ?>" 
            role="tabpanel" 
            aria-labelledby="nav-<?php echo $index; ?>-tab" 
            tabindex="0"
            data-title="<?= esc_attr(get_sub_field('title')); ?>" 
            data-text="<?= esc_attr(get_sub_field('text')); ?>">

              <div class="w-100 w-lg-75 d-flex flex-column gap-10 position-absolute mt-n250 start-50 translate-middle-x">
                <h3 class="text-center mb-0"><?= esc_attr(get_sub_field('title')); ?></h3>
                <p class="fs-5 text-center mb-0"><?= esc_attr(get_sub_field('text')); ?></p>
              </div>

              <div class="table-responsive-md">
                <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col" class="col-md-3 p-10 rounded-1 text-center title-tab text-white fs-6 fw-semibold align-middle">
                          <span class="text-white fs-6 fw-semibold">Date</span>
                        </th>
                        <th scope="col" class="col-md-3 p-10 rounded-1 text-center title-tab text-white fs-6 fw-semibold align-middle">
                          <span class="text-white fs-6 fw-semibold">Location</span>
                        </th>
                        <th scope="col" class="col-md-3 p-10 rounded-1  text-center title-tab text-white fs-6 fw-semibold align-middle">
                          <span class="text-white fs-6 fw-semibold">Day Camp</span>
                        </th>
                        <th scope="col" class="col-md-3 p-10 rounded-1  text-center title-tab text-white fs-6 fw-semibold align-middle">
                          <span class="text-white fs-6 fw-semibold">Grade 6-8</span>
                        </th>
                      </tr>
                    </thead>
                  <tbody>
                    <?php
                      if(have_rows('rate_dates_content')):
                      while(have_rows('rate_dates_content')): the_row(); 
                      $date = get_sub_field('date');
                      $location = get_sub_field('location');
                      $day_camp_price = get_sub_field('day_camp_price');
                      $grade_price = get_sub_field('grade_price');
                      $index = get_row_index();
                    ?>
                    <tr>
                      <td class="bg-tan text-center rounded-1 py-20 px-10">
                          <span class="fs-6"><?php echo $date; ?></span>
                      </td>
                      <td class="d-flex flex-column gap-5 bg-tan text-center rounded-1 py-20 px-10">
                        <?php if( $location ) : ?>
                          <p class="fs-6 mb-0"><?php echo $location['title']; ?></p>
                          <a href="<?php echo $location['url']; ?>" class="small"><?php echo $location['url']; ?></a>
                        <?php endif; ?>
                      </td>
                      <td class="bg-tan text-center rounded-1 py-20 px-10">  
                          <span class="fs-6"><?php echo $day_camp_price; ?></span>
                      </td>
                      <td class="bg-tan text-center rounded-1 py-20 px-10">   
                          <span class="fs-6"><?php echo $grade_price; ?></span>
                      </td>
                    </tr>

                    <?php endwhile; endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
          
          <?php endwhile; endif; ?>
      </div>

      <?php
       $register_link = get_field('register_link');
       if( $register_link ) :
      ?>
      <div class="d-flex justify-content-center">
        <a href="<?= $register_link['url']; ?>" class="btn <?= $theme_color === 'gold-theme' ? 'btn-gold' : 'btn-teal'; ?> btn-gold mb-50 mx-auto"><?= $register_link['title']; ?></a>
      </div>
      <?php endif; ?>
    

    </div>
</section>
