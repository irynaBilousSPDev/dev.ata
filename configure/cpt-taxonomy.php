<?php

// Custom Post types & Taxonomies
function bachelor_post_type()
{
    $labels = array(
        'name' => _x("Studia I stopnia", 'Post type general name', 'akademiata'),
        'singular_name' => _x("Bachelor", 'Post type singular name', 'akademiata'),
        'add_new' => _x('Add New', 'custom'),
        'add_new_item' => _x('Add New', 'akademiata'),
        'edit_item' => _x('Edit', 'akademiata'),
        'new_item' => _x('New', 'akademiata'),
        'view_item' => _x('View', 'akademiata'),
        'search_items' => _x('Search', 'akademiata'),
        'not_found' => _x('No found', 'akademiata'),
        'not_found_in_trash' => _x('No found in Trash', 'akademiata'),
        'parent_item_colon' => _x('Parent:', 'akademiata'),
        'menu_name' => _x("Bachelor", 'Admin Menu text', 'akademiata'),
    );
    $rewrite = array(
        'slug' => 'oferta/studia-1-stopnia',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => "Bachelor's degree specializations",
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'post-formats', 'custom-fields'),
        'taxonomies' => array('post_tag', 'degree', 'mode', 'obtained_title', 'promotions','department'),
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-awards',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => $rewrite,
        'public' => true,
        'has_archive' => 'bachelor',
        'capability_type' => 'post'
    );
    register_post_type('bachelor', $args); // max 20 character cannot contain capital letters and spaces
}

add_action('init', 'bachelor_post_type', 0);


function master_post_type()
{
    $labels = array(
        'name' => _x("Studia II stopnia", 'Post type general name', 'akademiata'),
        'singular_name' => _x('master', 'Post type singular name', 'akademiata'),
        'add_new' => _x('Add New', 'akademiata'),
        'add_new_item' => _x('Add New masterPost', 'akademiata'),
        'edit_item' => _x('Edit masterPost', 'akademiata'),
        'new_item' => _x('New masterPost', 'akademiata'),
        'view_item' => _x('View masterPost', 'akademiata'),
        'search_items' => _x('Search masterPosts', 'akademiata'),
        'not_found' => _x('No masterPosts found', 'akademiata'),
        'not_found_in_trash' => _x('No masterPosts found in Trash', 'akademiata'),
        'parent_item_colon' => _x('Parent masterPost:', 'akademiata'),
        'menu_name' => _x("Master", 'Admin Menu text', 'akademiata'),
    );

    $rewrite = array(
        'slug' => 'oferta/studia-2-stopnia',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => "Master's degree specializations",
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'post-formats', 'custom-fields'),
        'taxonomies' => array('post_tag', 'degree', 'mode', 'obtained_title', 'promotions', 'department'),
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => $rewrite,
        'public' => true,
        'has_archive' => 'master',
        'capability_type' => 'post'
    );
    register_post_type('master', $args); // max 20 character cannot contain capital letters and spaces
}

add_action('init', 'master_post_type', 0);

function register_discounts_cpt() {
    $labels = [
        'name'               => __('Discounts', 'akademiata'),
        'singular_name'      => __('Discount', 'akademiata'),
        'menu_name'          => __('Discounts', 'akademiata'),
        'name_admin_bar'     => __('Discount', 'akademiata'),
        'add_new'            => __('Add New', 'akademiata'),
        'add_new_item'       => __('Add New Discount', 'akademiata'),
        'new_item'           => __('New Discount', 'akademiata'),
        'edit_item'          => __('Edit Discount', 'akademiata'),
        'view_item'          => __('View Discount', 'akademiata'),
        'all_items'          => __('All Discounts', 'akademiata'),
        'search_items'       => __('Search Discounts', 'akademiata'),
        'parent_item_colon'  => __('Parent Discounts:', 'akademiata'),
        'not_found'          => __('No discounts found.', 'akademiata'),
        'not_found_in_trash' => __('No discounts found in Trash.', 'akademiata')
    ];

    $args = [
        'label'               => __('Discounts', 'akademiata'),
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-tag', // WordPress Dashicon for tags
        'show_in_rest'        => true, // Enable Gutenberg
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'taxonomies'          => ['discount_category'], // Attach Taxonomy
        'capability_type'     => 'post',
        'rewrite'             => ['slug' => 'discounts'],
    ];

    register_post_type('discounts', $args);
}
add_action('init', 'register_discounts_cpt');


/**
 * Create   taxonomies, kierynek and  Mode for the post types
 */
function wpdocs_create_study_taxonomies()
{

//     Degree - Studia
    $labels = array(
        'name' => _x('Degree', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Degree', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search degree', 'akademiata'),
        'all_items' => __('All degrees', 'akademiata'),
        'parent_item' => __('Parent degree', 'akademiata'),
        'parent_item_colon' => __('Parent degree:', 'akademiata'),
        'edit_item' => __('Edit degree', 'akademiata'),
        'update_item' => __('Update degree', 'akademiata'),
        'add_new_item' => __('Add New degree', 'akademiata'),
        'new_item_name' => __('New degree Name', 'akademiata'),
        'menu_name' => __('Degree', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'studia'),
    );

    register_taxonomy('degree', array('bachelor', 'master'), $args);

    // Add new taxonomy, make it hierarchical (like categories) programs - kierynek studiow
    $labels = array(
        'name' => _x('Programs', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Program', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search Program', 'akademiata'),
        'all_items' => __('All Program', 'akademiata'),
        'parent_item' => __('Parent Program', 'akademiata'),
        'parent_item_colon' => __('Parent Program:', 'akademiata'),
        'edit_item' => __('Edit Program', 'akademiata'),
        'update_item' => __('Update Program', 'akademiata'),
        'add_new_item' => __('Add New Program', 'akademiata'),
        'new_item_name' => __('New Program Name', 'akademiata'),
        'menu_name' => __('Programs', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'kierynek'),
    );

    register_taxonomy('program', array('bachelor', 'master'), $args);


    // Add new taxonomy, make it hierarchical (like categories) Study mode - Tryb
    $labels = array(
        'name' => _x('Mode', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Mode', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search Mode', 'akademiata'),
        'all_items' => __('All Mode', 'akademiata'),
        'parent_item' => __('Parent Mode', 'akademiata'),
        'parent_item_colon' => __('Parent Mode:', 'akademiata'),
        'edit_item' => __('Edit Mode', 'akademiata'),
        'update_item' => __('Update Mode', 'akademiata'),
        'add_new_item' => __('Add New Mode', 'akademiata'),
        'new_item_name' => __('New Mode Name', 'akademiata'),
        'menu_name' => __('Mode', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'tryb'),
    );

    register_taxonomy('mode', array('bachelor', 'master'), $args);

    // Add new taxonomy, make it hierarchical (like categories) Obtained title - Uzyskany tytuł
    $labels = array(
        'name' => _x('Obtained title', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Obtained title', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search Obtained title', 'akademiata'),
        'all_items' => __('All Obtained title', 'akademiata'),
        'parent_item' => __('Parent Obtained title', 'akademiata'),
        'parent_item_colon' => __('Parent Obtained title:', 'akademiata'),
        'edit_item' => __('Edit Obtained title', 'akademiata'),
        'update_item' => __('Update Obtained title', 'akademiata'),
        'add_new_item' => __('Add New Obtained title', 'akademiata'),
        'new_item_name' => __('New Obtained title Name', 'akademiata'),
        'menu_name' => __('Obtained title', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'uzyskany-tytul'),
    );

    register_taxonomy('obtained_title', array('bachelor', 'master'), $args);
    // Add new taxonomy, make it hierarchical (like categories) promotions
    $labels = array(
        'name' => _x('Promotions', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Promotions', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search Promotions', 'akademiata'),
        'all_items' => __('All Promotions', 'akademiata'),
        'parent_item' => __('Parent Promotions', 'akademiata'),
        'parent_item_colon' => __('Parent Promotions:', 'akademiata'),
        'edit_item' => __('Edit Promotions', 'akademiata'),
        'update_item' => __('Update Promotions', 'akademiata'),
        'add_new_item' => __('Add Promotions', 'akademiata'),
        'new_item_name' => __('New Promotions Name', 'akademiata'),
        'menu_name' => __('Promotions', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'promocje'),
    );

    register_taxonomy('promotions', array('bachelor', 'master'), $args);


    // Add new taxonomy, make it hierarchical (like categories) Language
    $labels = array(
        'name' => _x('Language', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Language', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search Language', 'akademiata'),
        'all_items' => __('All Language', 'akademiata'),
        'parent_item' => __('Parent Language', 'akademiata'),
        'parent_item_colon' => __('Parent Language:', 'akademiata'),
        'edit_item' => __('Edit Language', 'akademiata'),
        'update_item' => __('Update Language', 'akademiata'),
        'add_new_item' => __('Add Language', 'akademiata'),
        'new_item_name' => __('New Language Name', 'akademiata'),
        'menu_name' => __('Language', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'jezyk'),
    );

    register_taxonomy('language', array('bachelor', 'master'), $args);

    // Add new taxonomy, make it hierarchical (like categories) Duration
    $labels = array(
        'name' => _x('Duration', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Duration', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search Duration', 'akademiata'),
        'all_items' => __('All Duration', 'akademiata'),
        'parent_item' => __('Parent Duration', 'akademiata'),
        'parent_item_colon' => __('Parent Duration:', 'akademiata'),
        'edit_item' => __('Edit Duration', 'akademiata'),
        'update_item' => __('Update Duration', 'akademiata'),
        'add_new_item' => __('Add Duration', 'akademiata'),
        'new_item_name' => __('New Duration Name', 'akademiata'),
        'menu_name' => __('Duration', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'czas-trwania'),
    );

    register_taxonomy('duration', array('bachelor', 'master'), $args);
    // Add new taxonomy, make it hierarchical (like categories) Duration
    $labels = array(
        'name' => _x('Departments (Wydzialy)', 'taxonomy general name', 'akademiata'),
        'singular_name' => _x('Department', 'taxonomy singular name', 'akademiata'),
        'search_items' => __('Search department', 'akademiata'),
        'all_items' => __('All departments', 'akademiata'),
        'parent_item' => __('Parent department', 'akademiata'),
        'parent_item_colon' => __('Parent department:', 'akademiata'),
        'edit_item' => __('Edit department', 'akademiata'),
        'update_item' => __('Update department', 'akademiata'),
        'add_new_item' => __('Add department', 'akademiata'),
        'new_item_name' => __('New department Name', 'akademiata'),
        'menu_name' => __('Departments', 'akademiata'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'wydzial'),
    );

    register_taxonomy('department', array('bachelor', 'master'), $args);


}

// hook into the init action and call create_study_taxonomies when it fires
add_action('init', 'wpdocs_create_study_taxonomies', 0);
