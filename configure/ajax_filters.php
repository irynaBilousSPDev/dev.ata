<?php
//page offer
// Generalized filter function
function filter_posts_by_taxonomies($post_type, $taxonomies)
{
    // Base query arguments
    $args = [
        'post_type' => $post_type,
        'posts_per_page' => -1,
    ];

    // Initialize tax query
    $tax_query = ['relation' => 'AND'];

    if (!empty($_POST['form_data'])) {
        // Parse the form data from the POST request
        parse_str($_POST['form_data'], $form_data);

        // Build tax query
        foreach ($taxonomies as $taxonomy) {
            if (!empty($form_data[$taxonomy])) {
                $tax_query[] = [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $form_data[$taxonomy],
                    'operator' => 'IN',
                ];
            }
        }

        // Add tax_query if applicable
        if (count($tax_query) > 1) {
            $args['tax_query'] = $tax_query;
        }
    }

    // Execute WP_Query
    $query = new WP_Query($args);

    // Output results
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            get_template_part('./partials/card_post');
        endwhile;
    } else {
        echo '<div id="no-results">' . __('Nie znaleziono żadnych wyników', 'akademiata') . '</div>';
    }

    // Reset post data
    wp_reset_postdata();

    // End AJAX request
    wp_die();
}

// AJAX handler for general offer page
function filter_posts_ajax()
{
    $post_types = ['bachelor', 'master'];
    $taxonomies = ['degree', 'program', 'mode', 'post_tag', 'obtained_title', 'promotions'];
    filter_posts_by_taxonomies($post_types, $taxonomies);
}

add_action('wp_ajax_filter_posts', 'filter_posts_ajax');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts_ajax');

// AJAX handler for Bachelor degree page
function filter_bachelor_ajax()
{
    $post_type = 'bachelor';
    $taxonomies = ['program', 'mode', 'post_tag', 'obtained_title', 'promotions'];
    filter_posts_by_taxonomies($post_type, $taxonomies);
}

add_action('wp_ajax_filter_bachelor', 'filter_bachelor_ajax');
add_action('wp_ajax_nopriv_filter_bachelor', 'filter_bachelor_ajax');

// AJAX handler for Master degree page
function filter_master_ajax()
{
    $post_type = 'master';
    $taxonomies = ['program', 'mode', 'post_tag', 'obtained_title', 'promotions'];
    filter_posts_by_taxonomies($post_type, $taxonomies);
}

add_action('wp_ajax_filter_master', 'filter_master_ajax');
add_action('wp_ajax_nopriv_filter_master', 'filter_master_ajax');

