<?php
$acf_fields = get_query_var('acf_fields', []);
$student_testimonials = !empty($acf_fields['student_testimonials']) ? $acf_fields['student_testimonials'] : [];
// Check if section data exists before rendering
if (!empty($student_testimonials)) :
    $title = $student_testimonials['title'] ?? '';
    $idYoutube = $student_testimonials['id_youtube_playlist'] ?? '';
    ?>
    <section class="section_student_testimonials left_space pb-md-5 mb-5">
        <?php if (!empty($title)) : ?>
            <h2 class="sub_title primary_color py-3 mb-5">
                <?php echo esc_html($title); ?>
            </h2>
        <?php endif; ?>
        <?php
        // Pass YouTube playlist ID to template
        set_query_var('data_youtube_playlist', esc_attr($idYoutube));

        // Load YouTube Slider Template
        get_template_part('template-parts/youtube_slider');
        ?>
    </section>
<?php endif; ?>