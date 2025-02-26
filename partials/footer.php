<?php
/**
 * The template for displaying footer
 *
 * @package  akademiata
 */
?>
<footer class="site-footer">
    <?php locate_template('template-parts/partner_logos_slider.php', true, true); ?>
    <div class="footer_body">
        <div class="container">
            <div class="row">
                <div class="col-md-4 item">
                    <div class="logo_footer_wrapper">
                        <a title="<?php _e('Site Logo white', 'akademiata'); ?>" href="<?php echo get_home_url(); ?>">
                            <img src="<?php echo esc_url(get_template_directory_uri()) . '/static/img/logoFooterwhite.png'; ?>"
                                 alt="">
                        </a>
                    </div>
                    <div class="address">
                        ul. Olszewska 12,<br>
                        00-792 Warszawa<br><br>
                        + 48 22 825 80 34/35<br>
                        kontakt@akademiaTA.pl<br>
                    </div>
                </div>
                <div class="col-md-4 item">

                </div>
                <div class="col-md-4 item">
                    <nav id="site-navigation" class="main-navigation">
                        <?php wp_nav_menu(array('theme_location' => 'menu-main', 'menu_id' => 'menu-main')); ?>
                    </nav>
                    <ul>
                        <li><a href="/">Kontakt</a></li>
                        <li><a href="/">O nas</a></li>
                        <li><a href="/">Polityka prywatności</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="date">
            © ATA <?php echo date('Y'); ?>
        </div>
    </div>


</footer>
