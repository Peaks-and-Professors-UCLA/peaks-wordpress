<?php

// =============================================================================
// SINGLE-TRIPS.PHP
// -----------------------------------------------------------------------------
// Single post output for "trips" custom post type..
// =============================================================================

?>

<?php get_header(); ?>
  
  <div class="my-container mtl" role="main">

    <p class="back-link mbl"><a href="/upcoming-trips">Back to all trips</a></p>

    <div class="<?php x_main_content_class(); ?>" role="main">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="x-container">
            <div class="x-column x-sm x-1-2">
                <?php the_post_thumbnail($size='full'); ?>
            </div>

            <div class="x-column x-sm x-1-2">
                <h3 class="mtn"><?php the_title(); ?></h3>
                
                <?php
                    /* Only show sign-up buttons if trip has not passed! */
                    if (is_signup_open(get_the_ID())) :
                ?>
                    <div class="trip-signup-button">
                        <a href="<?php the_field('standard_sign_up_link'); ?>" target="_blank">Standard - $<?php the_field('standard_hiker_cost') ?></a>
                    </div>

                    <div class="trip-signup-button">
                        <a href="<?php the_field('driver_sign_up_link'); ?>" target="_blank">Driver - $<?php the_field('driver_cost') ?></a>
                    </div>
                <?php
                    elseif (!has_trip_happened(get_the_ID())) :
                ?>
                    <div class="text-normal">Signups open <?php the_field('signup_time')?>.</div>
                <?php
                    else :
                ?>
                    <div class="text-normal">Trip has completed.</div>
                <?php endif; ?>

                <div class="trip-date">
                    <p class="mbn">Start: <?php the_field('start_time'); ?></p>
                    <p>End: <?php the_field('end_time'); ?></p>
                </div>

                <div class="trip-description text-normal">
                    <p class="text-normal"><span class="text-bold">Important notice:</span> Please note that many parts of our trip sign-up process, most notably waitlist and waitlist acceptances, have recently changed. View our updated policies <a class="text-bold" href="https://peaksandprofessorsucla.org/trip-logistics/" target="#">here</a>.</p>

                    <?php the_content(); ?>
                    
                    <hr>

                    <?php
                        $trip_lead = get_post($post=get_field('trip_lead')[0]);
                    ?>

                    <p><b>Trip lead: </b><?php echo get_the_title($trip_lead); ?></p>

                    <p>Don't miss out on another trip! Subscribe to our mailing list today.</p>
                    <?php the_mailing_list_form() ?>
                </div>
            </div>
        </div>

      <?php endwhile; ?>

    </div>
  </div>

<?php get_footer(); ?>