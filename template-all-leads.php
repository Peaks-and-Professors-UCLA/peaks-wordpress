<?php

// TEMPLATE NAME: All Leads

// =============================================================================
// TEMPLATE-ALL-LEADS.PHP
// -----------------------------------------------------------------------------
// Page for displaying all leads
// =============================================================================

$fullwidth = true;

?>

<?php get_header(); ?>

<h1 class="big-header">Leads</h1>

<?php
$loop = new WP_Query( array(
    'post_type' => 'leads',
    'posts_per_page' => -1,
	'meta_key'			=> 'ranking',
	'orderby'			=> 'meta_value',
	'order'				=> 'ASC'
)
);
?>

<?php $leads_per_line = 4; ?>

<div>
  <div class="<?php x_main_content_class(); ?> my-container" role="main">
    
    <h2 class="small-header">Who are the trip leads?</h2>
    
    <p class="content-text text-center text-normal">
    We are a a pun-loving, ambitious, and down-to-earth group of student leaders from diverse backgrounds. Our team helps shape and improve this innovative, rapidly-growing student organization. Trip Leads network with stellar UCLA professors and invite them to various trips. By leading at least 1 trip each quarter and serving as a co-lead on other Peaks trips, there are myriads of opportunities to develop important skills such as leadership, project management, public speaking, and facilitating interpersonal connections.
    </p>

    <?php while ( $loop->have_posts() ) : ?>
        
        <div class="x-container">
            
            <?php for ($i = 0; is_posts($loop) and $i < $leads_per_line; $i++ ) : ?>
                <?php $loop->the_post(); ?>
                <div class="x-column x-sm x-1-<?php echo $leads_per_line; ?>" style="height: auto">

                        <a href="<?php the_permalink(); ?>">
                            <img class="lead-thumbnail" src="<?php echo the_post_thumbnail_url($size='large'); ?>">
                        </a>

                        <div class="lead-title-archive">
                            <a href="<?php the_permalink() ?>">
                                <p class="mbn"><?php the_title(); ?></p>
                            </a>

                            <p><?php echo get_post_meta(get_the_ID(), "position", true); ?></p>
                        </div>
                </div>
            <?php endfor; ?>

        </div>

    <?php endwhile; ?>
  </div>

  <?php if ( $fullwidth != 'on' ) : ?>
    <?php get_sidebar(); ?>
  <?php endif; ?>

</div>



<?php get_footer(); ?>