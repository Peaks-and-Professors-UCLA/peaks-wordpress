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


<?php if (has_post_thumbnail()) : ?>
<style>
.main-billboard {
    height: 580px;
    background: linear-gradient(rgba(10, 10, 10, 0.25), rgba(10, 10, 10, 0.25)), url("<?php the_post_thumbnail_url($size='full'); ?>") center no-repeat;
    background-size: cover;
}
</style>

<div class='main-billboard'>
    <div class='centered'>
        <div class='billboard-logo'>
            <p class='logo-text'><?php the_title() ?></p>
        </div>
    </div>
</div>
<?php endif ?>

<div class="my-container content-text">

    <?php if (!has_post_thumbnail()) : ?>

    <h1 class="big-header"><?php the_title(); ?></h1>

    <?php endif ?>


    <?php while ( have_posts() ) : the_post(); ?>
        <div class="text-dark">
            <?php the_content() ?>
        </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>