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
?>

<section id="rates-dates">
<?php 
  $id = get_the_ID();
?>
    <div class="container">

        <div class="d-flex flex-column gap-10">
          <h2 class="text-center text-grey600"><?= get_field('title', $id); ?></h2>
          <p class="fs-5 fw-normal text-center text-grey600"><?= get_field('text', $id); ?></p>
        </div>
          
        <div class="nav nav-tabs d-flex gap-5 ms-5" id="nav-tab" role="tablist">
              <?php
              $count = 0;
              if(have_rows('rates_dates')):
                while(have_rows('rates_dates')): the_row(); 
                $city_name = get_sub_field('city_name');
                $index = get_row_index();
                $count++;
              ?>
                <a href="javascript:void(0);" role="presentation" class="presentation-tab p-20 rounded-1 border border-3 border-tan text-center <?= $count == 1 ? 'active' : ''; ?>"
                    id="nav-<?php echo $index; ?>-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-<?php echo $index; ?>"
                    type="button"
                    role="tab"
                    aria-controls="nav-<?php echo $index; ?>"
                    aria-selected="false">
                    <span class="fs-5 fw-semibold"><?php echo $city_name; ?></span>
                </a>
              <?php endwhile; endif; ?>
        </div>

        <div class="tab-content">
            <?php
              $count = 0;
              if(have_rows('rates_dates')):
              while(have_rows('rates_dates')): the_row(); 
              $index = get_row_index();
              $count++;
            ?>
              <div class="tab-pane fade <?php echo $count === 1 ? 'show active' : ''; ?>" id="nav-<?php echo $index; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $index; ?>-tab" tabindex="0">
                <div class="table-responsive">
                  <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col" class="col col-md-3 p-10 rounded-1 bg-gold text-center">
                            <span class="text-white fs-5 fw-semibold">Date</span>
                          </th>
                          <th scope="col" class="col col-md-3 p-10 rounded-1 bg-gold text-center">
                            <span class="text-white fs-5 fw-semibold">Location</span>
                          </th>
                          <th scope="col" class="col col-md-3 p-10 rounded-1 bg-gold text-center">
                            <span class="text-white fs-5 fw-semibold">Day Camp</span>
                          </th>
                          <th scope="col" class="col col-md-3 p-10 rounded-1 bg-gold text-center">
                            <span class="text-white fs-5 fw-semibold">Grade 6-8</span>
                          </th>
                        </tr>
                      </thead>
                    <tbody>
                      <?php
                        $count = 0;
                        if(have_rows('rate_dates_content')):
                        while(have_rows('rate_dates_content')): the_row(); 
                        $date = get_sub_field('date');
                        $location = get_sub_field('location');
                        $day_camp_price = get_sub_field('day_camp_price');
                        $grade_price = get_sub_field('grade_price');
                        $index = get_row_index();
                        $count++;
                      ?>
                      <tr>
                        <td class="bg-tan text-center rounded-1 py-20 px-10">
                            <span class="fs-5 fw-normal text-grey600"><?php echo $date; ?></span>
                        </td>
                        <td class="d-flex flex-column gap-5 bg-tan text-center rounded-1 py-20 px-10">
                            <p class="fs-5 fw-normal text-grey600"><?php echo $location['title']; ?></p>
                            <a href="<?php echo $location['url']; ?>" class="fs-6 fw-normal text-grey600"><?php echo $location['url']; ?></a>
                        </td>
                        <td class="bg-tan text-center rounded-1 py-20 px-10">  
                           <span class="fs-5 fw-normal text-grey600"><?php echo $day_camp_price; ?></span>
                        </td>
                        <td class="bg-tan text-center rounded-1 py-20 px-10">   
                            <span class="fs-5 fw-normal text-grey600"><?php echo $grade_price; ?></span>
                        </td>
                      </tr>

                      <?php endwhile; endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            
            <?php endwhile; endif; ?>
        </div>

    </div>

</section>
