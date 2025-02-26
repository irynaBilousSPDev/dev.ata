<?php
$acf_fields = get_query_var('acf_fields', []);
$after_studies = !empty($acf_fields['after_studies']) ? $acf_fields['after_studies'] : [];
// Check if section data exists before rendering
if (!empty($after_studies)) :
    $title = $after_studies['title'] ?? '';
    $sub_title = $after_studies['sub_title'] ?? '';
    $image_content_slider = $after_studies['image_content_slider'] ?? [];
    ?>
    <section class="section_after_studies py-md-5 my-5">
        <div class="section_header">
            <div class="container">
                <?php if (!empty($title) || !empty($sub_title)) : ?>
                    <h2 class="title_section"><?php echo esc_html($title); ?></h2>
                    <h3 class="sub_title_section primary_color mb-5"><?php echo esc_html($sub_title); ?></h3>
                <?php endif; ?>
            </div>
        </div>
        <?php
        //  Pass `image_content_slider` only if it exists
        if (!empty($image_content_slider)) {
            set_query_var('image_content_slider', $image_content_slider);
            get_template_part('template-parts/image_content_slider');
        }
        ?>
    </section>
<?php endif; ?>