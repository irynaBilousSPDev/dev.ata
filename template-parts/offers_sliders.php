<?php
$post_types = get_query_var('post_types', []);
if (!empty($post_types)): ?>

    <?php // $post_types = ['bachelor', 'master'];
    if (!empty($post_types)) :
        foreach ($post_types as $post_type) :
            $cpt_object = get_post_type_object($post_type);

            if ($cpt_object) :
                $cpt_title = esc_html($cpt_object->labels->name); // CPT title
                $cpt_slug = !empty($cpt_object->rewrite['slug']) ? esc_html($cpt_object->rewrite['slug']) : ''; // Get CPT slug

                // WP_Query Arguments
                $args = [
                    'post_type' => $post_type,
                    'posts_per_page' => -1,
                    'orderby' => 'name',
                    'order' => 'ASC',
                ];

                // Execute WP_Query for each post type
                $query = new WP_Query($args);

                if ($query->have_posts()) : ?>
                    <section class="our_offer offer_<?php echo $post_type; ?> pb-3">
                        <div class="container">
                            <div class="offer_category_title d-flex py-3">
                                <h2 class="small_title"><?php echo $cpt_title; ?></h2>
                                <a title="<?php echo $cpt_title; ?>" href="<?php echo $cpt_slug; ?>">
                                    <?php _e('Zobacz wszystkie', 'akademiata'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="offer_category_slider py-3">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <?php
                                $slide_id = get_the_ID();
                                $slide_fields = get_fields($slide_id);

                                // ACF Image Handling
                                $acf_image = $slide_fields['image_thumb'] ?? [];
                                $image_thumb_url_desktop = $acf_image['sizes']['product_slider_thumb'] ?? '';
                                $image_thumb_url_mobile = $acf_image['sizes']['product_slider_thumb_mobile'] ?? '';
                                $alt_text = !empty($acf_image['alt']) ? esc_attr($acf_image['alt']) : esc_attr(get_the_title());

                                // WordPress Featured Image Fallback
                                $wp_image_desktop = get_the_post_thumbnail_url($slide_id, 'product_slider_thumb') ?: '';
                                $wp_image_mobile = get_the_post_thumbnail_url($slide_id, 'product_slider_thumb_mobile') ?: '';

                                // Final image selection
                                $image_url_desktop = $image_thumb_url_desktop ?: $wp_image_desktop;
                                $image_url_mobile = $image_thumb_url_mobile ?: $wp_image_mobile;

                                // Ensure an image is available
                                if (empty($image_url_desktop)) {
                                    $image_url_desktop = esc_url(get_template_directory_uri() . '/static/img/logo_ata_compact.webp'); // Set a default image
                                }
                                if (empty($image_url_mobile)) {
                                    $image_url_mobile = $image_url_desktop; // Use desktop image if mobile version is missing
                                }

                                // Category Handling
                                $categories = get_the_terms($slide_id, 'program');
                                $category_name = (!empty($categories) && !is_wp_error($categories)) ? esc_html($categories[0]->name) : '';

                                // Image ID and dimensions (used for aspect ratio if necessary)
                                $image_id = get_post_thumbnail_id($slide_id);
                                $image_meta = wp_get_attachment_metadata($image_id);
                                $width = $image_meta['width'] ?? 400;
                                $height = $image_meta['height'] ?? 230;
                                ?>

                                <div class="product_slide <?php echo esc_attr($post_type); ?>_slide">
                                    <img class="responsive-image"
                                         src="<?php echo esc_url($image_url_desktop); ?>"
                                         srcset="<?php echo esc_url($image_url_mobile); ?> 480w, <?php echo esc_url($image_url_desktop); ?> 1024w"
                                         sizes="(max-width: 768px) 480px, 1024px"
                                         alt="<?php echo esc_attr($alt_text); ?>"
                                         width="<?php echo esc_attr($width); ?>"
                                         height="<?php echo esc_attr($height); ?>"
                                         loading="lazy">

                                    <div class="details">
                                        <h3 class="small_title"><?php the_title(); ?></h3>
                                        <?php if (!empty($category_name)) : ?>
                                            <div class="category_name"><?php echo esc_html($category_name); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="more_details text-center">
                                        <h3 class="small_title"><?php the_title(); ?></h3>
                                        <a title="<?php the_title(); ?> - <?php echo esc_html($category_name); ?>"
                                           href="<?php the_permalink(); ?>" class="button-primary">
                                            <?php _e('Zobacz', 'akademiata'); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    </section>
                <?php endif;
                wp_reset_postdata();
            endif;
        endforeach;
    else : ?>
        <div id="no-results"><?php _e('Nie znaleziono żadnych wyników', 'akademiata'); ?></div>
    <?php endif; ?>

<?php endif; ?>
