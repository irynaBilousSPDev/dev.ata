<?php
get_header();
/* Template Name: Offer */
?>
<!--<article id="post---><?php //the_ID(); ?><!--" --><?php //post_class(); ?><!-- style="overflow: hidden;">-->
    <div class="offer_wrapper">
        <div class="offer_content">
            <!-- start breadcrumbs -->
            <?php the_breadcrumb(); ?>
            <!-- end breadcrumbs -->
            <h1><?php echo get_the_title(); ?></h1>
            <?php echo get_template_part('partials/tags_container'); ?>
            <div id="filter-results" class="row"></div>
        </div>

        <div id="sidebar" class="filter_col">
            <div id="scroller-anchor"></div>
            <?php echo get_template_part('partials/filter_side'); ?>
        </div>
    </div>
<!--</article>-->
<?php
get_footer();
