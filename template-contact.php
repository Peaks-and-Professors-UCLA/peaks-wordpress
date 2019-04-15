<?php

// TEMPLATE NAME: Contact page 

// =============================================================================
// TEMPLATE-CONTACT-PAGE.PHP
// -----------------------------------------------------------------------------
// Page for contact pages
// =============================================================================

$fullwidth = true;

?>

<?php get_header(); ?>

<h1 class="big-header"><?php the_title(); ?></h1>

<div class="my-container">
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="contact-container">
        <?php the_content() ?>
    </div>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>