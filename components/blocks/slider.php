<?php
/**
 * Slider Section
 * @file         slider.php
 * @package      Incredible Theme
 * @author       Justin Ward f
 * @copyright    2018 Incredible Marketing
 * @version      Release: 1.0.0
 * @since        available since Release 1.0.0
 */
/* Load swiper.js files */
swiperFiles();

$slider_type = get_sub_field('slider_type');
$container_width = get_sub_field('container_width');
$slider_settings = get_sub_field('slider_settings');

/* SLIDER SETTINGS */
if ($slider_settings) {
  $slider_atts = '';
  $slider_arrows = '';
  $slider_pagination = '';
  $slider_initial = $slider_settings['slider_initial'];
  if ($slider_initial) {
    $slider_atts .= ' data-initial="' . $slider_initial . '"';
  }
  $slider_direction = $slider_settings['slider_direction'];
  if ($slider_direction) {
    $slider_atts .= ' data-direction="' . $slider_direction . '"';
  }
  $slider_speed = $slider_settings['slider_speed'];
  if ($slider_speed) {
    $slider_atts .= ' data-speed="' . $slider_speed . '"';
  }
  $slider_effect = $slider_settings['slider_effect'];
  if ($slider_effect) {
    $slider_atts .= ' data-effect="' . $slider_effect . '"';
  }
  $slider_grabcursor = $slider_settings['slider_grabcursor'];
  if ($slider_grabcursor) {
    $slider_atts .= ' data-grabcursor="' . $slider_grabcursor . '"';
  }
  $slider_free_mode = $slider_settings['slider_free_mode'];
  if ($slider_free_mode) {
    $slider_atts .= ' data-freemode="' . $slider_free_mode . '"';
  }
  $slider_progress_bar = $slider_settings['slider_progress_bar'];
  $slider_preload_images = $slider_settings['slider_preload_images'];
  if ($slider_preload_images) {
    $slider_atts .= ' data-preloadimages="' . $slider_preload_images . '"';
  }
  $slider_loop = $slider_settings['slider_loop'];
  if ($slider_loop) {
    $slider_atts .= ' data-loop="' . $slider_loop . '"';
  }
  $slider_arrows = $slider_settings['slider_arrows'];
  if ($slider_arrows) {
    $slider_atts .= ' data-arrows="' . $slider_arrows . '"';
  }
  $slider_pagination = $slider_settings['slider_pagination'];
  if ($slider_pagination) {
    $slider_atts .= ' data-pagination="' . $slider_pagination . '"';
  }
  $slider_pagination_type = $slider_settings['slider_pagination_type'];
  if ($slider_pagination_type) {
    $slider_atts .= ' data-paginationtype="' . $slider_pagination_type . '"';
  }
  $slider_clickable_pagination = $slider_settings['slider_clickable_pagination'];
  if ($slider_clickable_pagination) {
    $slider_atts .= ' data-clickablepagination="' . $slider_clickable_pagination . '"';
  }
  $slider_parallax = $slider_settings['slider_parallax'];
  if ($slider_parallax) {
    $slider_atts .= ' data-parallax="' . $slider_parallax . '"';
  }
  $slide_height = $slider_settings['slide_height'];
  if ($slide_height) {
    $slider_atts .= ' data-slideheight="' . $slide_height . '"';
  }
  $slide_width = $slider_settings['slide_width'];
  if ($slide_width) {
    $slider_atts .= ' data-slidewidth="' . $slide_width . '"';
  }
  $slidePerView = $slider_settings['slides_per_view'];
  if ($slidePerView) {
    if ($slidesPerView == 0) {
      $slidesPerView = 'auto';
    }
    $slider_atts .= ' data-slidesperview="' . $slidePerView . '"';
  }
} ?>

<section class="slider" <?php if ($slider_type) {
                          echo ' data-type="' . $slider_type . '"';
                        } ?>>
  <div class="<?php echo $container_width; ?>">
    <div class="row">
      <div class="col-12">
        <?php

        /* GALLERY SLIDES ========================================
        ========================================================== */
        if ($slider_type == 'gallery') {
          $slides = get_sub_field('gallery_slides');
          if ($slides) : ?>
            <div class="gallery-slider swiper-container" <?php if ($slider_atts) {
                                                            echo $slider_atts;
                                                          } ?>>
              <div class="swiper-wrapper">
                <?php foreach ($slides as $post) : setup_postdata($post);
                  $gallery = get_field('gallery_images');
                  $size = 'full';
                  if ($gallery) : ?>
                    <?php foreach ($gallery as $image) : ?>
                      <div class="swiper-slide">
                        <?php echo wp_get_attachment_image($image['ID'], $size); ?>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endforeach;
              wp_reset_postdata(); ?>
              </div>
              <?php if ($slider_pagination === 1) { ?><div class="swiper-pagination"></div><?php } ?>
              <?php if ($slider_arrows === 1) { ?><div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div><?php } ?>
              <?php if ($slider_progress_bar === 1) { ?><div class="swiper-scrollbar"></div><?php } ?>
            </div><?php
              endif;

              /* TEAM SLIDES ===========================================
				========================================================== */
            } elseif ($slider_type == 'team_member') {
              $slides = get_sub_field('team_slides');
              if ($slides) : ?>
            <div class="team-slider swiper-container" <?php if ($slider_atts) {
                                                        echo $slider_atts;
                                                      } ?>>
              <div class="swiper-wrapper">
                <?php foreach ($slides as $post) : setup_postdata($post); ?>
                  <div class="swiper-slide">

                  </div>
                <?php endforeach;
              wp_reset_postdata(); ?>
              </div>
              <?php if ($slider_pagination === 1) { ?><div class="swiper-pagination"></div><?php } ?>
              <?php if ($slider_arrows === 1) { ?><div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div><?php } ?>
              <?php if ($slider_progress_bar === 1) { ?><div class="swiper-scrollbar"></div><?php } ?>
            </div><?php
              endif;

              /* PROCEDURE SLIDES ======================================
				========================================================== */
            } elseif ($slider_type == 'procedure') {
              $slides = get_sub_field('procedure_slides');
              if ($slides) : ?>
            <div class="procedure-slider swiper-container" <?php if ($slider_atts) {
                                                              echo $slider_atts;
                                                            } ?>>
              <div class="swiper-wrapper">
                <?php foreach ($slides as $post) : setup_postdata($post); ?>
                  <div class="swiper-slide">

                  </div>
                <?php endforeach;
              wp_reset_postdata(); ?>
              </div>
              <?php if ($slider_pagination === 1) { ?><div class="swiper-pagination"></div><?php } ?>
              <?php if ($slider_arrows === 1) { ?><div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div><?php } ?>
              <?php if ($slider_progress_bar === 1) { ?><div class="swiper-scrollbar"></div><?php } ?>
            </div><?php
              endif;

              /* TESTIMONIAL SLIDES ====================================
				========================================================== */
            } elseif ($slider_type == 'testimonial') {
              $slides = get_sub_field('testimonial_slides');
              if ($slides) : ?>
            <div class="testimonial-slider swiper-container" <?php if ($slider_atts) {
                                                                echo $slider_atts;
                                                              } ?>>
              <div class="swiper-wrapper">
                <?php foreach ($slides as $post) : setup_postdata($post); ?>
                  <div class="swiper-slide">

                  </div>
                <?php endforeach;
              wp_reset_postdata(); ?>
              </div>
              <?php if ($slider_pagination === 1) { ?><div class="swiper-pagination"></div><?php } ?>
              <?php if ($slider_arrows === 1) { ?><div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div><?php } ?>
              <?php if ($slider_progress_bar === 1) { ?><div class="swiper-scrollbar"></div><?php } ?>
            </div><?php
              endif;

              /* PAGE SLIDES ===========================================
				========================================================== */
            } elseif ($slider_type == 'page') {
              $slides = get_sub_field('page_slides');
              if ($slides) : ?>
            <div class="page-slider swiper-container" <?php if ($slider_atts) {
                                                        echo $slider_atts;
                                                      } ?>>
              <div class="swiper-wrapper">
                <?php foreach ($slides as $post) : setup_postdata($post); ?>
                  <div class="swiper-slide">

                  </div>
                <?php endforeach;
              wp_reset_postdata(); ?>
              </div>
              <?php if ($slider_pagination === 1) { ?><div class="swiper-pagination"></div><?php } ?>
              <?php if ($slider_arrows === 1) { ?><div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div><?php } ?>
              <?php if ($slider_progress_bar === 1) { ?><div class="swiper-scrollbar"></div><?php } ?>
            </div><?php
              endif;

              /* POST SLIDES ===========================================
				========================================================== */
            } elseif ($slider_type == 'post') {
              $slides = get_sub_field('post_slides');
              if ($slides) : ?>
            <div class="post-slider swiper-container" <?php if ($slider_atts) {
                                                        echo $slider_atts;
                                                      } ?>>
              <div class="swiper-wrapper">
                <?php foreach ($slides as $post) : setup_postdata($post); ?>
                  <div class="swiper-slide">

                  </div>
                <?php endforeach;
              wp_reset_postdata(); ?>
              </div>
              <?php if ($slider_pagination === 1) { ?><div class="swiper-pagination"></div><?php } ?>
              <?php if ($slider_arrows === 1) { ?><div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div><?php } ?>
              <?php if ($slider_progress_bar === 1) { ?><div class="swiper-scrollbar"></div><?php } ?>
            </div><?php
              endif;

              /* CUSTOM SLIDES =========================================
				========================================================== */
            } elseif ($slider_type == 'custom') { /*
					$slides = get_sub_field('custom_slides');							if($slides): ?>
        <div class="slider swiper-container" <?php if($slider_atts){echo $slider_atts;} ?>>
          <div class="swiper-wrapper">
            <?php foreach( $slides as $post): setup_postdata($post); ?>
            <div class="swiper-slide">

            </div>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
        </div><?php
					endif;*/ } ?>
      </div>
    </div>
  </div>
</section>