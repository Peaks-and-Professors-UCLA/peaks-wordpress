<?php

// TEMPLATE NAME: Front page

// =============================================================================
// TEMPLATE-FRONT-PAGE.PHP
// -----------------------------------------------------------------------------
// Page for Front page
// =============================================================================

$fullwidth = true;

?>

<?php get_header(); ?>

<div class="home-container text-normal">

    <div class="image-title-container">
        <img class="image-title-image" src="<?php the_post_thumbnail_url($size='full'); ?>">
        <div class="image-title-text">Peaks & Professors at UCLA</div>
    </div>

    <div class="x-container">
        <!-- <div class="announcement"></div> -->
        <div class="x-column x-sm x-1-2">
            <p>Peaks & Professors at UCLA is a student organization that organizes hikes with students and professors, giving students the opportunity to experience the outdoors in a whole new way by forming new connections with professors and their peers. Interested? Join our mailing list (form to the right), and view our <a href="/upcoming-trips">upcoming trips</a>.</p>
        </div>

        <div class="x-column x-sm x-1-2">
            <p>Want to stay updated? Subscribe to our mailing list!</p>
            <?php the_mailing_list_form(); ?>
        </div>
    </div>

    <h3 class="medium-header">Our upcoming trips</h3>

    <?php
        $loop = new WP_Query( array(
            'post_type' => 'trips',
            'posts_per_page' => -1,
            'meta_key'			=> 'start_time',
            'orderby'			=> 'meta_value',
            'order'				=> 'ASC'
        )
        );

        $trips_per_row = 3;
    ?>

    <div class="trip-preview-row x-container">
        
        <?php for ($i = 0; $i < $trips_per_row and $loop->have_posts(); ) : ?>
            <?php $loop->the_post() ?>
            <?php if (!has_trip_happened(get_the_ID())) : $i++; ?>
                <div class="x-column x-sm x-1-<?php echo $trips_per_row ?>">
                    <a href="<?php the_permalink(); ?>">
                        <img class="trip-preview-image" src="<?php the_post_thumbnail_url($size='large'); ?>">
                    </a>

                    <p><?php the_title() ?></p>
                </div>
            <?php endif; ?>
        <?php endfor; ?>

    </div>

</div>
<?php get_footer(); ?>
