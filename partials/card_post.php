<div class="card_post_item">
    <div class="card_post_wrapper">
        <div class="card_post_image">
            <?php
            $thumbnail_id = get_post_thumbnail_id($post->ID);
            $image_size = 'specialization_card_thumb';
            // Get Image URL in Specific Size
            $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, $image_size);

            if (!empty($thumbnail_url)) : ?>
                <div role="img" class="image_bg" aria-label="<?php echo esc_attr(get_the_title($post->ID)); ?>"
                     style="background-image: url(<?php echo $thumbnail_url; ?>)"></div>
            <?php endif; ?>
        </div>
        <?php
        $terms = wp_get_post_terms($post->ID,
            array(
                'degree',
                'language',
                'obtained_title',
                'duration',
            ));
        //                                var_dump($terms);
        ?>
        <div class="card_post_body">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="card_properties_wrapper">
                <div class="row">
                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                        <?php
                        // Define a mapping of taxonomy to titles
                        $taxonomy_titles = [
                            'degree' => 'Rodzaj studiów',
                            'language' => 'Język studiów',
                            'obtained_title' => 'Uzyskany tytuł',
                            'duration' => 'Czas trwania',
                        ];
                        // Sort terms based on the order in $taxonomy_titles
                        usort($terms, function ($a, $b) use ($taxonomy_titles) {
                            $order_a = array_search($a->taxonomy, array_keys($taxonomy_titles));
                            $order_b = array_search($b->taxonomy, array_keys($taxonomy_titles));
                            return $order_a <=> $order_b;
                        });
                        ?>
                        <?php foreach ($terms as $term) : ?>
                            <?php
                            // Retrieve the title based on the term's taxonomy
                            $card_property_title = $taxonomy_titles[$term->taxonomy] ?? '';
                            ?>
                            <div class="col-md-6 card_property">
                                <div class="sub_title">
                                    <?php echo $card_property_title; ?>
                                </div>
                                <h3>
                                    <?php echo esc_html($term->name); ?>
                                </h3>
                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>
                </div>
            </div>
            <div class="buttons_wrapper">
                <a class="button-primary" href="<?php the_permalink(); ?>"><?php _e('SZCZEGÓŁY', 'akademiata'); ?></a>
                <a class="button-sing_up" href="<?php echo home_url(); ?>"><?php _e('ZAPISZ SIĘ', 'akademiata'); ?></a>
            </div>
        </div>
    </div>
</div>