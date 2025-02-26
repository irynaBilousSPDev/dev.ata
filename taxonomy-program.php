<?php
/**
 * Template for displaying Custom Categories.
 */

get_header(); ?>

<main id="site-content" role="main" class="py-1" style="background-color: #F5F5F5;">
    <div class="container">
        <header class="taxonomy-header">
            <h1 class="taxonomy-title my-5">
                <?php _e('Kierunek studiów '); ?> - <?php single_term_title(); ?>
            </h1>
            <div class="taxonomy-description">
                <?php echo term_description(); ?>
            </div>
        </header>

        <?php if (have_posts()) : ?>
            <div class="taxonomy-posts">
                <div class="row">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('./partials/card_post'); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else : ?>
            <p><?php esc_html_e('No posts found.', 'akademiata'); ?></p>
        <?php endif; ?>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
