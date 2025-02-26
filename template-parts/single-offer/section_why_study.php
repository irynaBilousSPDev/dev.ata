<?php
$acf_fields = get_query_var('acf_fields', []);
$why_study = !empty($acf_fields['why_study']) ? $acf_fields['why_study'] : [];

// Check if section data exists before rendering
if (!empty($why_study) && !empty($why_study['why_study_cards'])) :
    $title = $why_study['title'] ?? '';
    $content = $item['content'] ?? '';
    ?>
    <section class="section_why_study left_space py-md-5">
        <?php if (!empty($title)) : ?>
            <h2 class="title_section primary_color mb-5">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <div class="why_study_slider new_study_slider">
            <?php foreach ($why_study['why_study_cards'] as $card) :
                // Ensure $card['image'] exists before accessing its keys
                $image = $card['image'] ?? [];

                $image_url_fallback = !empty($image['url']) ? esc_url($image['url']) : '';

                $image_url_mobile = !empty($image['sizes']['study_slider_image_mobile']) ? esc_url($image['sizes']['study_slider_image_mobile']) : $image_url_fallback;
                $image_url_desktop = !empty($image['sizes']['study_slider_image']) ? esc_url($image['sizes']['study_slider_image']) : $image_url_fallback;

                $alt_text = !empty($image['alt']) ? esc_attr($image['alt']) : __('Study Image', 'akademiata');

                $title = $card['title'] ?? '';
                $content = $card['content'] ?? '';

                ?>

                <div class="slider_card">
                    <div class="image_wrapper">
                        <img src="<?php echo $image_url_desktop; ?>"
                             data-mobile="<?php echo $image_url_mobile; ?>"
                             data-desktop="<?php echo $image_url_desktop; ?>"
                             class="responsive-image"
                             alt="<?php echo esc_attr($alt_text); ?>">
                    </div>
                    <div class="card_body">
                        <div class="content">
                            <?php if (!empty($title)) : ?>
                                <h2 class="sub_title mb-3"><?php echo esc_html($title); ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($content)) : ?>
                                <p><?php echo wp_kses_post($content); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </section>
<?php endif; ?>

