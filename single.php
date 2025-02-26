<?php
/**
 * The template for displaying single posts
 *
 * @package  akademiata theme
 */
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <!-- Start breadcrumbs -->
        <?php the_breadcrumb(); ?>
        <!-- End breadcrumbs -->

        <?php
        /* Start the Loop */
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content-single');

                // ACF - Flexible Content fields
                $sections = get_field('qorp_post_sections');

                if (!empty($sections) && is_array($sections)) :
                    foreach ($sections as $section) :
                        if (isset($section['acf_fc_layout'])) {
                            $template = str_replace('_', '-', $section['acf_fc_layout']);
                            get_template_part('flexible-content/sections/' . esc_attr($template), '', $section);
                        }
                    endforeach;
                endif;

            endwhile;
        else :
            // Display message if no post is found
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </div>
</article>

