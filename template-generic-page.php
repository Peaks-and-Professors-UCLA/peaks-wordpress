<?php

// TEMPLATE NAME: Generic page 

// =============================================================================
// TEMPLATE-GENERIC-PAGE.PHP
// -----------------------------------------------------------------------------
// Page for generic pages
// =============================================================================

$fullwidth = true;

?>

<?php get_header(); ?>




<div class="my-container content-text">

    <?php if (has_post_thumbnail()) : ?>
    <div class="image-title-container">
        <img class="image-title-image" src="<?php the_post_thumbnail_url($size='full'); ?>">
        <div class="image-title-text"><?php the_title(); ?></div>
    </div>

    <?php else : ?>

    <h1 class="big-header"><?php the_title(); ?></h1>

    <?php endif ?>


    <?php while ( have_posts() ) : the_post(); ?>
        <div class="text-dark">
            <?php the_content() ?>
        </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>