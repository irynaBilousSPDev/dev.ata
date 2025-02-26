<?php
/**
 * The template for displaying header
 *
 * @package  akademiata
 */
?>

<header id="masthead" class="site-header">
    <div class="header_top_lang_nav">
        <div class="container">
            <ul class="lan_nav">
                <li class="active">
                    <a href="/">PL</a>
                </li>
                <li>
                    <a href="/">EN</a>
                </li>
                <li>
                    <a href="/">UA</a>
                </li>
                <li>
                    <a href="/">RU</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="left_space">
        <div class="container">
            <div class="site_navigation_wrapper">
                <div class="site-branding">
                    <a title="<?php _e('Akademia Techniczno-Artystyczna Nauk Stosowanych w Warszawie'); ?>"
                       href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img alt="Logo"
                             src="<?php echo get_template_directory_uri() ?>/static/img/akademiata_logo.png">
                    </a>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                    <?php wp_nav_menu(array('theme_location' => 'menu-main', 'menu_id' => 'menu-main')); ?>
                </nav>
            </div>

            <!-- #site-navigation -->
        </div>
    </div>
</header>
