<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until content.
 *
 * @package  akademiata
 */

?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Permissions-Policy" content="compute-pressure=()">
    <!--or add to .htaccess-->
    <!--    Header always set Permissions-Policy "compute-pressure=()"-->
    <?php wp_head(); ?>
</head>
<?php
//$youtube_api_key = get_field('youtube_api_key', 'option'); // ACF Global Field
$my_youtube_api_key = 'AIzaSyAmv-a8SXP2ckayL-RawlIGSR6VA4oS3-E'; // ACF Global Field
$youtube_api_key = 'AIzaSyC-O5PCUNxaFhOdnJ-ZOcEG67f05xerpwo'; // ACF Global Field
?>
<body <?php body_class(); ?> data-youtube-api-key="<?php echo $youtube_api_key; ?>">
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'akademiata'); ?></a>

    <?php locate_template('partials/header.php', true, true); ?>

    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">