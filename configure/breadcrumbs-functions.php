<?php
/*=============================================
=            BREADCRUMBS			            =
=============================================*/
function the_breadcrumb()
{

    $offer_link = '<a href="/oferta/">oferta</a>';
    $sep = ' | ';

    if (!is_front_page()) {

        // Start the breadcrumb with a link to your homepage
        echo '<div class="breadcrumbs">';
        echo '<a href="';
        echo get_option('home');
        echo '">home</a>' . $sep;

        // Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single()) {
            the_category('title_li=');
        } elseif (is_archive() || is_single()) {
            if (is_day()) {
                printf(__('%s', 'akademiata'), get_the_date());
            } elseif (is_month()) {
                printf(__('%s', 'akademiata'), get_the_date(_x('F Y', 'monthly archives date format', 'akademiata')));
            } elseif (is_year()) {
                printf(__('%s', 'akademiata'), get_the_date(_x('Y', 'yearly archives date format', 'akademiata')));
            } else {
                _e('Blog Archives', 'akademiata');
            }
        }

        // If the current page is a single post, show its title with the separator
//        if (is_single()) {
//            echo $sep;
//            the_title();
//        }

        if (is_singular(array('bachelor', 'master'))) {
            echo $offer_link , $sep;
            the_title();
        } elseif (is_single()) {
            echo $sep;
            the_title();
        }

        // If the current page is a static page, show its title.
        if (is_page(array(24, 26))) {
            echo $offer_link, $sep;
            the_title();
        } elseif
        (is_page()) {
            echo the_title();
        }

        // if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()) {
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ($page_for_posts_id) {
                $post = get_post($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }

        echo '</div>';
    }
}

?>
