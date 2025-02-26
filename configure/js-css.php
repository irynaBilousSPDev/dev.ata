<?php
/**
 * Enqueue scripts.
 */
function akademiata_enqueue_scripts()
{
    // Get the theme directory URL
    $theme_dir = get_template_directory_uri();
// force all scripts to load in footer
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    wp_enqueue_script(
        'bootstrap-script',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"',
        array('jquery'),
        null,
        true);
    wp_enqueue_script(
        'poper',
        'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js',
        array('jquery'),
        null,
        true);

    // Enqueue the main JavaScript file
    wp_enqueue_script(
        'name-main-js',
        $theme_dir . '/assets/dist/js/main.js',
        array(), // No dependencies
        null, // No versioning (use null or version from filemtime for cache-busting)
        true // Load in the footer
    );
}

add_action('wp_enqueue_scripts', 'akademiata_enqueue_scripts', 100);


/**
 * Enqueue styles.
 */
function akademiata_enqueue_styles()
{
    // Get the theme directory URL
    $theme_dir = get_template_directory_uri();

    // Dequeue unnecessary default WordPress styles
    $styles_to_dequeue = array(
        'wp-block-library',          // Core Gutenberg block library
        'wp-block-library-theme',    // Gutenberg block theme styles
        'wc-block-style',            // WooCommerce block styles
        'global-styles',             // Global styles from WordPress
        'classic-theme-styles',      // Classic theme styles
    );
    foreach ($styles_to_dequeue as $style) {
        wp_dequeue_style($style);
    }
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');

    // Enqueue Typekit Fonts
//    wp_enqueue_style(
//        'adobe-fonts',
//        'https://use.typekit.net/dic8cvr.css',
//        array(),
//        null
//    );

    // Enqueue the main stylesheet
    wp_enqueue_style(
        'name-main-css',
        $theme_dir . '/assets/dist/css/main.css',
        array(), // No dependencies
        null, // No versioning (use null or version from filemtime for cache-busting)
        'all'
    );

}

add_action('wp_enqueue_scripts', 'akademiata_enqueue_styles');
