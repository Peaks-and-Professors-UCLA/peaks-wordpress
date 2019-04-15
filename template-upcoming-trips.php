<?php

// TEMPLATE NAME: Upcoming Trips 

// =============================================================================
// VIEWS/TEMPLATE-UPCOMING-TRIPS.PHP
// -----------------------------------------------------------------------------
// Page for upcoming trips
// =============================================================================

$fullwidth = true;

?>

<?php get_header(); ?>

  <h1 class="big-header">Upcoming Trips</h1>


  <?php
  $loop = new WP_Query( array(
      'post_type' => 'trips',
      'posts_per_page' => -1,
      'meta_key'			=> 'start_time',
      'orderby'			=> 'meta_value',
      'order'				=> 'ASC'    
  )
  );
  ?>

  <div>
    <div class="<?php x_main_content_class(); ?> my-container" role="main">
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php if (!has_trip_happened(get_the_ID())) : ?>
        <div class="trip-row x-container">
          
          <div class="x-column x-sm x-2-5">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($size='large'); ?></a>
          </div>
          
          <div class="x-column x-sm x-3-5">
            <div class="mbs">
              <h3 class="trip-title-archive"><a href="<?php the_permalink() ?>"><?php the_title()?></a></h3>
            </div>
            <div class="trip-date-archive">
              <p class="mbn">Start: <?php the_field('start_time'); ?></p>
              <p class="mbn">End: <?php the_field('end_time'); ?></p>
            </div>

            <div class="trip-description-archive text-dark">
              <?php the_content(); ?>
            </div>
          </div>

        </div>
      <?php endif; ?>
      <?php endwhile; wp_reset_query(); ?>
    </div>

</div>

<?php get_footer(); ?>