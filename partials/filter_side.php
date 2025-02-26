<div id="scroller" class="filter_side">
    <?php
    $taxonomies = array(
        'degree' => 'Studia',
        'program' => 'Kierunek studiów',
        'post_tag' => 'ZAINTERESOWANIA',
        'obtained_title' => 'UZYSKANY TYTUŁ',
        'promotions' => 'PROMOCJE',
        'mode' => 'Tryb studiów',
    );

    // Get the current page slug
    $current_page_slug = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    ?>

    <form id="ajax-filter-form">
        <?php foreach ($taxonomies as $taxonomy => $taxonomy_name) :
            $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ]);

            // Skip the "degree" taxonomy if the page slug matches a term slug
            if ($taxonomy === 'degree' && !empty($terms)) {
                $matching_term = array_filter($terms, function ($term) use ($current_page_slug) {
                    return $term->slug === basename($current_page_slug); // Check if slug matches
                });

                if (!empty($matching_term)) {
                    continue; // Skip this taxonomy group
                }
            }
            ?>

            <?php if (!is_wp_error($terms)) : ?>
            <div class="taxonomy_group mb-3">
                <h2 class="filter_accordion_header active">
                    <?php echo esc_html(ucwords(str_replace('_', ' ', $taxonomy_name))); ?>
                    <div class="arrow-open-close">
                </h2>
                <div class="accordion-content" style="display: block">
                    <div class="labels_list">
                        <?php
                        $selected_terms = isset($_GET[$taxonomy]) ? (array)$_GET[$taxonomy] : [];

                        foreach ($terms as $term) :
                            $checked = in_array($term->slug, $selected_terms) ? 'checked' : '';
                            ?>
                            <label>
                                <input type="checkbox"
                                       name="<?php echo esc_attr($taxonomy); ?>[]"
                                       value="<?php echo esc_attr($term->slug); ?>" <?php echo $checked; ?>>
                                <?php echo esc_html($term->name); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </form>
</div>
