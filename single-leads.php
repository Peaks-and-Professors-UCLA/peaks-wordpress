<?php

// =============================================================================
// SINGLE-LEADS.PHP
// -----------------------------------------------------------------------------
// Single post output for "leads" custom post type..
// =============================================================================

?>

<?php get_header(); ?>

<div class="my-container">
  <p class="back-link mbl"><a href="/leads">Back to all leads</a></p>

  <h1 class="lead-title medium-header"><?php the_title(); ?></h1>
  <h4 class="lead-position-title"><?php echo get_post_meta(get_the_ID(), "position", true); ?></h2>

  <div class="lead-content <?php x_main_content_class(); ?>" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="x-container">
          <div class="x-column x-sm x-1-2">
              <?php the_post_thumbnail($size='full'); ?>
          </div>
          <div class="x-column x-sm x-1-2">
              
              <div class="lead-description text-normal">
                  <?php the_content() ?>
              </div>
          </div>
      </div>

    <?php endwhile; ?>

  </div>
</div>

<?php get_footer(); ?>