<?php
/**
 * Template part for displaying page
 *
 * @package  akademiata
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <section>
        <?php the_title('<h1>', '</h1>'); ?>

        <?php
        the_content();
        ?>
    </section>
</article>