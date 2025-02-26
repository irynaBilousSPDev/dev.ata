<?php

// CPT TAXONOMY

include('configure/cpt-taxonomy.php');

// Utilities

include('configure/utilities.php');

// ajax filter

include('configure/ajax_filters.php');

// CONFIG

include('configure/configure.php');

// JAVASCRIPT & CSS

include('configure/js-css.php');

// SHORTCODES

include('configure/shortcodes.php');

// BREADCRUMBS

include( 'configure/breadcrumbs-functions.php' );

// duplicate CPT posts

include('configure/duplicate-cpt-posts.php');

// ACF

include('configure/acf.php');

// HOOKS ADMIN

if (is_admin()) {
    include('configure/admin.php');
}

