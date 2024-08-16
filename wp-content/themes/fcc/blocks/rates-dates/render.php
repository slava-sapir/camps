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
          <h2 class="text-center text-grey600"><?= get_field('main_title'); ?></h2>
          <p class="fs-5 fw-normal text-center text-grey600"><?= get_field('sub_text'); ?></p>
        </div>
          
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <?php
              $count = 0;
              if(have_rows('rates_dates')):
                while(have_rows('rates_dates')): the_row(); 
                $city_name = get_sub_field('city_name');
                $index = get_row_index();
                $count++;
              ?>
                <a href="javascript:void(0);" role="presentation" class=" <?= $count == 1 ? 'active' : ''; ?>"
                    id="nav-<?php echo $index; ?>-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-<?php echo $index; ?>"
                    type="button"
                    role="tab"
                    aria-controls="nav-<?php echo $index; ?>"
                    aria-selected="false">
                    <?php echo $city_name; ?>
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

                <table class="table table-bordered">
                  <?php if($index == 1) : ?>
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Day Camp</th>
                        <th scope="col">Grade 6-8</th>
                      </tr>
                    </thead>
                  <?php endif; ?>
                  <tbody>
                    <?php
                      $count = 0;
                      if(have_rows('rate_dates_content')):
                      while(have_rows('experience_repeater')): the_row(); 
              
                        $index = get_row_index();
                        $count++;
                    ?>
                    <tr>
                      <td></td>
                    </tr>

                    <?php endwhile; endif; ?>
                  </tbody>
                </table>
              
              </div>
            
            <?php endwhile; endif; ?>
        </div>

    </div>

</section>
