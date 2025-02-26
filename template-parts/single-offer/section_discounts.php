<?php
$acf_fields = get_query_var('acf_fields', []);
$discounts_group = !empty($acf_fields['discounts_group']) ? $acf_fields['discounts_group'] : [];

if (!empty($discounts_group)) :
    $title = $discounts_group['title'] ?? '';
    $discount_ids = $discounts_group['discounts'] ?? [];
//    var_dump($discount_ids);

    // Ensure IDs exist before querying
    if (!empty($discount_ids)) {
        // Fetch all discount posts using WP_Query (with correct order)
        $query = new WP_Query([
            'post_type' => 'discounts',
            'post__in' => $discount_ids,
            'orderby' => 'post__in',
            'posts_per_page' => -1,
        ]);
    }
    ?>

    <section class="section_discounts">
        <div class="container">
            <?php if (!empty($title)) : ?>
                <h2 class="title_section mb-5"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($query) && $query->have_posts()) : ?>
                <div class="discounts">
                    <div class="row">
                        <?php while ($query->have_posts()) : $query->the_post();
                            $discount_id = get_the_ID(); // ✅ Correctly set post ID

                            // Fetch all ACF fields for this post in one go
                            $discount_fields = get_fields($discount_id);

                            // Retrieve fields safely
                            $description = $discount_fields['description'] ?? '';
                            $more_description = $discount_fields['more_description'] ?? '';
                            $entry_fee = !empty($discount_fields['entry_fee']); // ✅ Boolean check
                            ?>

                            <div class="col-md-6 col-xl-3">
                                <div class="discount_card">
                                    <div class="discount_card_body">
                                        <h3 class="small_title mb-5"><?php the_title(); ?></h3>

                                        <?php if ($entry_fee) : ?>
                                            <div class="discount_number title_section primary_color">
                                                <span>0</span> <?php esc_html_e('zł', 'akademiata'); ?>
                                                <br> <?php esc_html_e('wpisowego', 'akademiata'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="content">
                                            <?php echo wp_kses_post($description); ?>
                                        </div>
                                    </div>
                                    <div class="discount_card_button">
                                        <button></button>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); // Reset global post data ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
