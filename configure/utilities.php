<?php

// Utilities functions here

function add_filter_rewrite_rules()
{
    add_rewrite_rule(
        '^filter/([^/]+)/([^/]+)/?',
        'index.php?taxonomy_filter=$matches[1]&term_filter=$matches[2]',
        'top'
    );
}

add_action('init', 'add_filter_rewrite_rules');

// Register custom query vars
function add_filter_query_vars($vars)
{
    $vars[] = 'taxonomy_filter';
    $vars[] = 'term_filter';
    return $vars;
}

add_filter('query_vars', 'add_filter_query_vars');

// Flush rewrite rules on activation
function flush_rewrite_rules_on_activation()
{
    add_filter_rewrite_rules();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'flush_rewrite_rules_on_activation');


function enqueue_filter_scripts()
{
    wp_enqueue_script(
        'ajax-filter',
        get_template_directory_uri() . '/assets/dist/js/ajaxFilter.js',
        ['jquery'],
        null,
        true
    );
    // Localize script to pass the page ID
    wp_localize_script('ajax-filter', 'wpData', [
        'page_id' => get_queried_object_id(), // Current page ID
    ]);

    wp_localize_script('ajax-filter', 'ajax_filter_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}

add_action('wp_enqueue_scripts', 'enqueue_filter_scripts');


//function get_cached_acf_fields() {
//    $cache_key = 'acf_fields_' . get_the_ID();
//    $acf_data = get_transient($cache_key);
//
//    if (!$acf_data) {
//        $acf_data = get_fields(); // Fetch all ACF fields at once
//        set_transient($cache_key, $acf_data, 12 * HOUR_IN_SECONDS); // Cache for 12 hours
//    }
//
//    return $acf_data;
//}
//
//$acf_fields = get_cached_acf_fields(); // Get all ACF fields from cache

/**
 * Renders taxonomy information with links for specific taxonomies.
 *
 * @param array $taxonomy_labels Array of taxonomy slugs as keys and labels as values.
 */
function render_taxonomy_info($taxonomy_labels) {
    if (empty($taxonomy_labels) || !is_array($taxonomy_labels)) {
        return;
    }

    foreach ($taxonomy_labels as $taxonomy => $label) {
        $terms = get_the_terms(get_the_ID(), $taxonomy);

        if (!empty($terms) && !is_wp_error($terms)) {
            $term_links = array_map(function ($term) use ($taxonomy) {
                return ($taxonomy === 'program')
                    ? sprintf('<a title="%s" href="%s"><span class="primary_color"> %s </span></a>',
                        esc_attr($term->name),
                        esc_url(get_term_link($term)),
                        esc_html($term->name))
                    : esc_html($term->name);
            }, $terms);

            printf(
                '<div class="taxonomy_info"><strong>%s</strong>:<span class="primary_color"> %s </span></div>',
                esc_html($label),
                implode(', ', $term_links)
            );
        }
    }
}

/**
 * Renders structured taxonomy details with custom links for specific taxonomies.
 *
 * @param array  $taxonomy_labels Array of taxonomy slugs as keys and labels as values.
 * @param string $custom_degree_slug Custom slug for the "degree" taxonomy (optional).
 */
function render_taxonomy_details($taxonomy_labels, $custom_degree_slug = 'oferta') {
    if (empty($taxonomy_labels) || !is_array($taxonomy_labels)) {
        return;
    }

    foreach ($taxonomy_labels as $taxonomy => $label) {
        $terms = get_the_terms(get_the_ID(), $taxonomy);

        if (!empty($terms) && !is_wp_error($terms)) {
            $term_links = array_map(function ($term) use ($taxonomy, $custom_degree_slug) {
                $term_slug = $term->slug;

                // Custom link for 'degree' taxonomy
                if ($taxonomy === 'degree' && !empty($custom_degree_slug)) {
                    $term_link = home_url("/{$custom_degree_slug}/{$term_slug}/");
                    return sprintf('<a title="%s" href="%s">%s</a>', esc_attr($custom_degree_slug . ' - ' . $term->name), esc_url($term_link), esc_html($term->name));
                }

                return esc_html($term->name); // Plain text for other taxonomies
            }, $terms);

            // Output the structured HTML
            printf(
                '<div class="taxonomy_info">
                    <div class="row">
                        <div class="col-5 col-md-4 item">%s:</div>
                        <div class="col-7 col-md-8 item">%s</div>
                    </div>
                </div>',
                esc_html($label),
                implode(', ', $term_links)
            );
        }
    }
}




